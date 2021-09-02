<?php

namespace App\Services;

use App\Models\Seller;
use Carbon\Carbon;

class EarningService
{
    public $seller;
    public $periods = [];
    public $timeFormat = 'd-M-Y';
    public $seperator = '--';
    public $orders;

    public $currentPeriod;
    public $nextTransactionPeriod;

    public function __construct($seller)
    {
        if (!$seller instanceof Seller) {
            $seller = Seller::findOrFail($seller);
        }
        $created_at = $seller->created_at;
        $date = $created_at->clone();
        $this->seller = $seller;

        while ($date->year <= date('Y')) {
            // First Month
            if ($date->year == $created_at->year && $date->month == $created_at->month) {
                if ($date->day <= 15) {
                    $this->periods[] = $this->firstHalf($date->firstOfMonth());
                }
                $this->periods[] = $this->lastHalf($date->firstOfMonth());
            }
            // Last Month
            else if ($date->year == date('Y') && $date->month == date('m')) {
                $this->periods[] = $this->firstHalf($date);
                date('d') <= 15 || (
                    $this->periods[] = $this->lastHalf($date)
                );
                break;
            }
            // Else
            else {
                $this->periods[] = $this->firstHalf($date);
                $this->periods[] = $this->lastHalf($date);
            }

            $date->addMonth();
        }

        $this->currentPeriod = end($this->periods);
        $this->nextTransactionPeriod();
    }

    private function firstHalf($date): string
    {
        return $date->format($this->timeFormat) . $this->seperator . $date->copy()->addDays(14)->format($this->timeFormat);
    }

    private function lastHalf($date): string
    {
        return $date->copy()->addDays(15)->format($this->timeFormat) . $this->seperator . $date->copy()->lastOfMonth()->format($this->timeFormat);
    }

    public function orders($period)
    {
        return $this->orders = $this->seller->orders()
            ->where(function($query) use ($period) {
                list($start_date, $end_date) = explode($this->seperator, $period);
                $start_date = Carbon::parse($start_date);
                $end_date = Carbon::parse($end_date)->endOfDay();

                $query->whereBetween('data->completed_at', [$start_date, $end_date])
                    ->orWhereBetween('data->returned_at', [$start_date, $end_date]);
            })
            ->orderBy('updated_at', 'asc')
            ->get();
    }

    public function completedOrders()
    {
        if (! $this->orders) {
            return null;
        }

        return $this->orders->filter(function ($order) {
            return $order->status == 'completed';
        });
    }

    public function returnedOrders()
    {
        if (! $this->orders) {
            return null;
        }

        return $this->orders->filter(function ($order) {
            return $order->status == 'returned';
        });
    }

    public function nextTransactionPeriod($currentPeriod = null)
    {
        if ($currentPeriod) {
            $this->currentPeriod = $currentPeriod;
        }

        if (! $this->currentPeriod) {
            return null;
        }

        list($start_date, $end_date) = array_map(function ($date) {
            return Carbon::parse($date);
        }, explode($this->seperator, $this->currentPeriod));

        $fOfMon = $start_date->copy()->firstOfMonth();
        $mOfMon = $fOfMon->copy()->addDays(14);
        $lOfMon = $end_date->copy()->lastOfMonth();

        $fOfNextMon = $fOfMon->copy()->addMonth()->firstOfMonth();
        $mOfNextMon = $fOfNextMon->copy()->addDays(14);

        return $this->nextTransactionPeriod
            = $end_date->day > 15 ? [
            $fOfNextMon, $mOfNextMon->endOfDay(),
        ] : [
            $mOfMon->addDay(), $lOfMon->endOfDay(),
        ];
    }

    public function carbonBetween($period = null): array
    {
        $period || ($period = $this->currentPeriod);

        [$start_date, $end_date] = array_map(function ($date) {
            return Carbon::parse($date);
        }, explode($this->seperator, $period));

        return [$start_date, $end_date->endOfDay()];
    }

    public function howPaid($currentPeriod = null)
    {
        if ($currentPeriod) {
            $this->nextTransactionPeriod($currentPeriod);
        }

        $transactions = $this->seller->transactions()->status('paid')->whereBetween('updated_at', $this->nextTransactionPeriod)->get();
        return $transactions->isEmpty() ? null : $transactions->sum('amount');
    }
}
