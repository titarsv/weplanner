<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImageTableSeeder::class);
        $this->call(SentinelUsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(UserDataSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(TermRelationshipsTableSeeder::class);
        $this->call(TermTaxonomyTableSeeder::class);
        $this->call(AttributesSeeder::class);
        $this->call(AttributeValuesSeeder::class);
        $this->call(CategoryAttributesSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(UserCategoriesSeeder::class);
        $this->call(UserServicesSeeder::class);
        $this->call(UserAttributesSeeder::class);
    }
}
