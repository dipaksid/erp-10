<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Permission comes before User seeder here.
        $this->call(PermissionTableSeeder::class);
        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AgentsTableSeeder::class);
        $this->call(ArcnTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(ArmatchedTableSeeder::class);
        $this->call(BankdocsTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(CategoryVersionTableSeeder::class);
        $this->call(CompanysettingTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CustomerCategoriesTableSeeder::class);
        $this->call(CustomerGroupsTableSeeder::class);
        $this->call(CustomerGroupDetailsTableSeeder::class);
        $this->call(CustomerPkpbTableSeeder::class);
        $this->call(CustomerPwspgappTableSeeder::class);
        $this->call(CustomerServicesTableSeeder::class);
        $this->call(CustomerTotalpayappTableSeeder::class);
        $this->call(EstkTableSeeder::class);
        $this->call(EvaluationdetailTableSeeder::class);
        $this->call(EvaluationformTableSeeder::class);
        $this->call(GstrateTableSeeder::class);
        $this->call(HardwareloanTableSeeder::class);
        $this->call(LeaveformTableSeeder::class);
        $this->call(PaymentvouchersTableSeeder::class);
        $this->call(PrintlogTableSeeder::class);
        $this->call(PurchaseorderdetailsTableSeeder::class);
        $this->call(PurchaseordersTableSeeder::class);
        $this->call(ReceiptsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(SalesinvoicedetailsTableSeeder::class);
        $this->call(SalesinvoicesTableSeeder::class);
        $this->call(ServicelogTableSeeder::class);
        $this->call(ServicerateTableSeeder::class);
        $this->call(ServicetrainingTableSeeder::class);
        $this->call(SoftwareserviceTableSeeder::class);
        $this->call(SolutionprofileTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(StockCategoriesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(SystemsettingTableSeeder::class);
        $this->call(TasalesreceiptTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(TestPaymentTableSeeder::class);
        $this->call(TrainingformTableSeeder::class);
        $this->call(TrainingformdetailTableSeeder::class);
        $this->call(UomsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);
        $this->call(ApiOauthUsersTableSeeder::class);
    }
}
