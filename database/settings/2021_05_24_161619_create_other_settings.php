<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateOtherSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('other', function (SettingsBlueprint $table) {
            //
        });
    }

    public function down()
    {
        $this->migrator->inGroup('other', function (SettingsBlueprint $table) {
            //
        });
    }
}
