<?php

use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSocialTable extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup('social', function (SettingsBlueprint $table) {
            $table->add('facebook', null);
            $table->add('twitter', null);
            $table->add('instagram', null);
            $table->add('youtube', null);
        });
    }

    public function down()
    {
        $this->migrator->inGroup('social', function (SettingsBlueprint $table) {
            $table->delete('facebook');
            $table->delete('twitter');
            $table->delete('instagram');
            $table->delete('youtube');
        });
    }
}
