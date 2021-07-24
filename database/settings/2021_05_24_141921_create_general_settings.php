<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('general', function (SettingsBlueprint $table) {
            $table->add('logo', '');
            $table->add('favicon', '');
            $table->add('site_name', config('app.name'));
            $table->add('tagline', 'Developed By Hotash.');
            $table->add('contact_email', 'Contact Email');
            $table->add('contact_phone', 'Contact Phone');
            $table->add('company_address', 'Company Address');
        });
    }

    public function down()
    {
        $this->migrator->inGroup('general', function (SettingsBlueprint $table) {
            $table->delete('logo');
            $table->delete('favicon');
            $table->delete('site_name');
            $table->delete('tagline');
            $table->delete('contact_email');
            $table->delete('contact_phone');
            $table->delete('company_address');
        });
    }
}
