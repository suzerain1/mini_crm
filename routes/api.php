<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/*======Public routes======*/

//Auth: Login
Route::post('/login', [AuthController::class, 'login']);

//Auth: Store token
Route::put('/storetoken/{id}', [AuthController::class, 'storeToken']);

//::::Company:::::

//Get All Companies
Route::get('/companies', [CompanyController::class, 'getCompanies']);

//Get company by ID
Route::get('/companies/{id}', [CompanyController::class, 'getCompanyById']);

//::::Employee:::::

//Get Employee by Company ID
Route::get('/employees/comp/{id}', [EmployeeController::class, 'getEmployee']);

//Get Employee by ID
Route::get('/employees/{id}', [EmployeeController::class, 'getEmployeeById']);


/*======Protected routes======*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    //Company: Create new Company
    Route::post('/companies', [CompanyController::class, 'addCompany']);

    //Company: Delete Company
    Route::delete('/companies/{id}', [CompanyController::class, 'deleteCompany']);

    //Company: Update Company
    Route::put('/companies/{id}', [CompanyController::class, 'updateCompany']);

    //Company: Create new Employee
    Route::post('/employees', [EmployeeController::class, 'addEmployee']);

    //Employee: Update Employee
    Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']);

    //Company: Delete Employee
    Route::delete('/employees/{id}', [EmployeeController::class, 'deleteEmployee']);

    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
});


