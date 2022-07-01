<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{


$permissions = [

        ' Invoices',
        ' Invoices List',
        ' Paid Invoices',
        ' Partially Paid Invoices',
        ' Unpaid Invoices',
        ' Archive Invoices',
        ' Reports',
        ' Invoices Reports',
        ' Customers Reports',
        ' Users',
        ' Users List',
        ' Users Permissions',
        ' Settings',
        ' Products',
        ' Section',
        ' Add Invoice ',
        ' Delete Invoice ',
        ' Excel Export ',
        ' Payment Status Change  ',
        ' Invoice Modifying ',
        ' Invoice Archive ',
        ' Print Invoice',
        ' Add Attachments ',
        ' Delete Attachments ',

        ' Add User ',
        ' Modify User ',
        ' Delete User  ',

        ' Show Permission ',
        ' Add Permission',
        ' Modify Permission ',
        ' Delete Permission ',

        ' Add Product ',
        ' Modify Product',
        ' Delete Product',

        ' Add Section',
        ' Modify Section',
        ' Delete Section',
        ' Notification',

];



foreach ($permissions as $permission) {

Permission::create(['name' => $permission]);
}


}
}
