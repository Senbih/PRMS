<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeamleaderController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\VicePresidentController;
use App\Http\Controllers\PresidentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard/users', [AdminController::class, 'userIndex'])->name('admin.users');
    Route::get('/admin/dashboard/users-create', [AdminController::class, 'createUser'])->name('admin.users-create');
    Route::post('/admin/dashboard/users-store', [AdminController::class, 'storeUser'])->name('admin.users-store');
    Route::delete('/admin/dashboard/delete/{user}', [AdminController::class, 'userDestroy'])->name('admin.user-delete');
    Route::get('/admin/dashboard/edit/{user}', [AdminController::class, 'userEdit'])->name('admin.user-edit');
    Route::put('/admin/dashboard/update/{user}', [AdminController::class, 'userUpdate'])->name('admin.user-update');
    Route::put('/admin/dashboard/reset/{user}', [AdminController::class, 'userResetPassword'])->name('admin.user-reset');
    // department routes

    Route::get('/admin/dashboard/department-create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/admin/dashboard/department-store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/admin/dashboard/department-edit/{department}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/admin/dashboard/department-update/{department}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/admin/dashboard/department-destroy/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
    Route::get('/admin/dashboard/departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('/departments/search-users', [DepartmentController::class, 'searchUsers'])->name('department.searchUsers');
    Route::post('/departments/{department}/add-member/{user}', [DepartmentController::class, 'addMember'])->name('department.addMember');
    Route::post('departments/{department}/assign-teamleader', [DepartmentController::class, 'assignTeamLeader'])->name('department.assignTeamLeader');
    // Assign department user routes 
    Route::get('/admin/dashboard/department-assign', [DepartmentUserController::class, 'index'])->name('dept.users');
    Route::get('/admin/dashboard/department-assign/{user}', [DepartmentUserController::class, 'create'])->name('dept.assign');
    Route::post('/admin/dashboard/department-assign/{user}', [DepartmentUserController::class, 'store'])->name('dept.store');
    Route::get('/admin/dashboard/user', [SearchController::class, 'adminSearchUser'])->name('admin.search-user');
    Route::get('/admin/dashboard/departmentuser', [SearchController::class, 'adminSearchDepartmentUser'])->name('admin.search-departmentuser');

    Route::get('/admin/dashboard/division-create', [DivisionController::class, 'create'])->name('division.create');
    Route::post('/admin/dashboard/division-store', [DivisionController::class, 'store'])->name('division.store');
    Route::get('/admin/dashboard/division-edit/{division}', [DivisionController::class, 'edit'])->name('division.edit');
    Route::put('/admin/dashboard/division-update/{division}', [DivisionController::class, 'update'])->name('division.update');
    Route::delete('/admin/dashboard/division-destroy/{division}', [DivisionController::class, 'destroy'])->name('division.destroy');
    Route::get('/admin/dashboard/divisions', [DivisionController::class, 'index'])->name('division.index');

    Route::get('/admin/dashboard/office-create', [OfficeController::class, 'create'])->name('office.create');
    Route::post('/admin/dashboard/office-store', [OfficeController::class, 'store'])->name('office.store');
    Route::get('/admin/dashboard/office-edit/{office}', [OfficeController::class, 'edit'])->name('office.edit');
    Route::put('/admin/dashboard/office-update/{office}', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('/admin/dashboard/office-destroy/{office}', [OfficeController::class, 'destroy'])->name('office.destroy');
    Route::get('/admin/dashboard/offices', [OfficeController::class, 'index'])->name('office.index');

    Route::get('/admin/dashboard/campus-create', [CampusController::class, 'create'])->name('campus.create');
    Route::post('/admin/dashboard/campus-store', [CampusController::class, 'store'])->name('campus.store');
    Route::get('/admin/dashboard/campus-edit/{campus}', [CampusController::class, 'edit'])->name('campus.edit');
    Route::put('/admin/dashboard/campus-update/{campus}', [CampusController::class, 'update'])->name('campus.update');
    Route::delete('/admin/dashboard/campus-destroy/{campus}', [CampusController::class, 'destroy'])->name('campus.destroy');
    Route::get('/admin/dashboard/campuses', [CampusController::class, 'index'])->name('campus.index');
});
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('staff/create-content', [StaffController::class, 'createContent'])->name('staff.create-content');
    Route::post('staff/store-content', [StaffController::class, 'storeContent'])->name('staff.store-content');
    Route::delete('staff/delete-content/{content}', [StaffController::class, 'deleteContent'])->name('staff.delete-content');
    Route::get('staff/my-content', [StaffController::class, 'myContent'])->name('staff.my-content');
    Route::get('staff/create-report', [StaffController::class, 'createReport'])->name('staff.create-report');
    Route::post('staff/store-report', [StaffController::class, 'storeReport'])->name('staff.store-report');
    Route::get('staff/my-reports', [StaffController::class, 'myReports'])->name('staff.my-reports');
    Route::delete('staff/delete-report/{report}', [StaffController::class, 'deleteReport'])->name('staff.delete-report');
});


Route::middleware(['auth', 'role:teamleader'])->group(function () {
    Route::get('/teamleader/dashboard', [TeamleaderController::class, 'dashboard'])->name('teamleader.dashboard');
    Route::get('/teamleader/dashboard/staffs', [TeamleaderController::class, 'viewStaff'])->name('teamleader.staffs');
    Route::get('/teamleader/dashboard/department', [TeamleaderController::class, 'viewDepartment'])->name('teamleader.mydepartment');
    Route::get('/teamleader/dashboard/department/content', [TeamleaderController::class, 'departmentContent'])->name('department.content');
    Route::post('/teamleader/dashboard/department/content', [TeamleaderController::class, 'addContent'])->name('department.savecontent');
    Route::get('/teamleader/dashboard/department/content-list', [TeamleaderController::class, 'viewcontentList'])->name('department.contentlist');
    Route::delete('/teamleader/dashboard/department/content-delete/{content}', [TeamleaderController::class, 'destroyContent'])->name('teamleader.content-delete');
    Route::get('/teamleader/dashboard/content', [SearchController::class, 'searchContent'])->name('teamleader.search-content');
    Route::get('/teamleader/dashboard/staff', [SearchController::class, 'searchStaff'])->name('teamleader.search-staff');
    Route::post('/teamleader/content/{content}/approve', [TeamleaderController::class, 'approveContent'])->name('teamleader.approve-content');
    Route::post('/teamleader/content/{content}/disapprove', [TeamleaderController::class, 'disapproveContent'])->name('teamleader.disapprove-content');


    Route::get('teamleader/profile', [TeamleaderController::class, 'profileedit'])->name('teamleaderprofile.edit');
    Route::patch('teamleader/profile', [TeamleaderController::class, 'profileupdate'])->name('teamleaderprofile.update');
    Route::delete('teamleader/profile', [TeamleaderController::class, 'destroy'])->name('teamleader-profile.destroy');

    Route::get('teamleader/view-content', [TeamleaderController::class, 'viewDepartmentContent'])->name('teamleader.view-content');
    Route::post('teamleader/add-comment/{content}', [TeamleaderController::class, 'addComment'])->name('teamleader.add-comment');

    Route::get('teamleader/view-staff-reports', [TeamleaderController::class, 'viewReports'])->name('teamleader.view-staff-reports');

    Route::get('/teamleader/create-plan-for-division', [TeamleaderController::class, 'createPlanForDivision'])->name('teamleader.create-plan-for-division');
    Route::post('/teamleader/store-plan-for-division', [TeamleaderController::class, 'storePlanForDivision'])->name('teamleader.store-plan-for-division');
    Route::get('/teamleader/create-report-for-division', [TeamleaderController::class, 'createReportForDivision'])->name('teamleader.create-report-for-division');
    Route::post('/teamleader/store-report-for-division', [TeamleaderController::class, 'storeReportForDivision'])->name('teamleader.store-report-for-division');
    Route::delete('/teamleader/delete-plan/{content}', [TeamleaderController::class, 'deletePlan'])->name('teamleader.delete-plan');
    Route::delete('/teamleader/delete-report/{content}', [TeamleaderController::class, 'deleteReport'])->name('teamleader.delete-report');
    Route::get('/teamleader/my-plans', [TeamleaderController::class, 'myPlans'])->name('teamleader.my-plans');
    Route::get('/teamleader/my-reports', [TeamleaderController::class, 'myReports'])->name('teamleader.my-reports');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Routes for directors with extended functionalities
Route::middleware(['auth', 'role:director'])->group(function () {

    Route::get('/director/dashboard', [DirectorController::class, 'dashboard'])->name('director.dashboard');
    Route::get('/director/dashboard/teamleaders', [DirectorController::class, 'viewTeamleader'])->name('director.teamleaders');
    Route::get('/director/dashboard/division', [DirectorController::class, 'viewdivision'])->name('director.mydivision');
    Route::get('/director/dashboard/division/content', [DirectorController::class, 'divisionContent'])->name('division.content');
    Route::post('/director/dashboard/division/content', [DirectorController::class, 'addContent'])->name('division.savecontent');
    Route::get('/director/dashboard/division/content-list', [DirectorController::class, 'viewcontentList'])->name('division.contentlist');
    Route::delete('/director/dashboard/division/content-delete/{content}', [DirectorController::class, 'destroyContent'])->name('director.content-delete');
    Route::get('/director/dashboard/content', [SearchController::class, 'searchContentd'])->name('director.search-content');
    Route::get('/director/dashboard/teamleader', [SearchController::class, 'searchTeamleader'])->name('director.search-teamleader');
    Route::post('/director/content/{content}/approve', [DirectorController::class, 'approveContent'])->name('director.approve-content');
    Route::post('/director/content/{content}/disapprove', [DirectorController::class, 'disapproveContent'])->name('director.disapprove-content');


    Route::get('director/profile', [DirectorController::class, 'profileedit'])->name('directorprofile.edit');
    Route::patch('director/profile', [DirectorController::class, 'profileupdate'])->name('directorprofile.update');
    Route::delete('director/profile', [DirectorController::class, 'destroy'])->name('director-profile.destroy');

    Route::get('director/view-content', [DirectorController::class, 'viewdivisionContent'])->name('director.view-content');
    Route::post('director/add-comment/{content}', [DirectorController::class, 'addComment'])->name('director.add-comment');

    Route::get('director/view-teamleader-reports', [DirectorController::class, 'viewReports'])->name('director.view-teamleader-reports');

    Route::get('/director/create-plan-for-office', [DirectorController::class, 'createPlanForOffice'])->name('director.create-plan-for-office');
    Route::post('/director/store-plan-for-office', [DirectorController::class, 'storePlanForOffice'])->name('director.store-plan-for-office');
    Route::get('/director/create-report-for-office', [DirectorController::class, 'createReportForOffice'])->name('director.create-report-for-office');
    Route::post('/director/store-report-for-office', [DirectorController::class, 'storeReportForOffice'])->name('director.store-report-for-office');
    Route::delete('/director/delete-plan/{content}', [DirectorController::class, 'deletePlan'])->name('director.delete-plan');
    Route::delete('/director/delete-report/{content}', [DirectorController::class, 'deleteReport'])->name('director.delete-report');
    Route::get('/director/my-plans', [DirectorController::class, 'myPlans'])->name('director.my-plans');
    Route::get('/director/my-reports', [DirectorController::class, 'myReports'])->name('director.my-reports');
});
Route::middleware(['auth', 'role:vice_president'])->group(function () {

    Route::get('/vice_president/dashboard', [VicePresidentController::class, 'dashboard'])->name('vice_president.dashboard');
    Route::get('/vice_president/dashboard/directors', [VicePresidentController::class, 'viewDirector'])->name('vice_president.directors');
    Route::get('/vice_president/dashboard/office', [VicePresidentController::class, 'viewoffice'])->name('vice_president.myoffice');
    Route::get('/vice_president/dashboard/office/content', [VicePresidentController::class, 'officeContent'])->name('office.content');
    Route::post('/vice_president/dashboard/office/content', [VicePresidentController::class, 'addContent'])->name('office.savecontent');
    Route::get('/vice_president/dashboard/office/content-list', [VicePresidentController::class, 'viewcontentList'])->name('office.contentlist');
    Route::delete('/vice_president/dashboard/office/content-delete/{content}', [VicePresidentController::class, 'destroyContent'])->name('vice_president.content-delete');
    Route::get('/vice_president/dashboard/content', [SearchController::class, 'searchContentv'])->name('vice_president.search-content');
    Route::get('/vice_president/dashboard/director', [SearchController::class, 'searchDirector'])->name('vice_president.search-director');
    Route::post('/vice_president/content/{content}/approve', [VicePresidentController::class, 'approveContent'])->name('vice_president.approve-content');
    Route::post('/vice_president/content/{content}/disapprove', [VicePresidentController::class, 'disapproveContent'])->name('vice_president.disapprove-content');


    Route::get('vice_president/profile', [VicePresidentController::class, 'profileedit'])->name('vice_presidentprofile.edit');
    Route::patch('vice_president/profile', [VicePresidentController::class, 'profileupdate'])->name('vice_presidentprofile.update');
    Route::delete('vice_president/profile', [VicePresidentController::class, 'destroy'])->name('vice_president-profile.destroy');

    Route::get('vice_president/view-content', [VicePresidentController::class, 'viewofficeContent'])->name('vice_president.view-content');
    Route::post('vice_president/add-comment/{content}', [VicePresidentController::class, 'addComment'])->name('vice_president.add-comment');

    Route::get('vice_president/view-director-reports', [VicePresidentController::class, 'viewReports'])->name('vice_president.view-director-reports');

    Route::get('/vice_president/create-plan-for-campus', [VicePresidentController::class, 'createPlanForcampus'])->name('vice_president.create-plan-for-campus');
    Route::post('/vice_president/store-plan-for-campus', [VicePresidentController::class, 'storePlanForcampus'])->name('vice_president.store-plan-for-campus');
    Route::get('/vice_president/create-report-for-campus', [VicePresidentController::class, 'createReportForcampus'])->name('vice_president.create-report-for-campus');
    Route::post('/vice_president/store-report-for-campus', [VicePresidentController::class, 'storeReportForcampus'])->name('vice_president.store-report-for-campus');
    Route::delete('/vice_president/delete-plan/{content}', [VicePresidentController::class, 'deletePlan'])->name('vice_president.delete-plan');
    Route::delete('/vice_president/delete-report/{content}', [VicePresidentController::class, 'deleteReport'])->name('vice_president.delete-report');
    Route::get('/vice_president/my-plans', [VicePresidentController::class, 'myPlans'])->name('vice_president.my-plans');
    Route::get('/vice_president/my-reports', [VicePresidentController::class, 'myReports'])->name('vice_president.my-reports');
});


Route::middleware(['auth', 'role:president'])->group(function () {

    Route::get('/president/dashboard', [PresidentController::class, 'dashboard'])->name('president.dashboard');
    Route::get('/president/dashboard/vice_presidents', [PresidentController::class, 'viewVice_president'])->name('president.vice_presidents');
    Route::get('/president/dashboard/campus', [PresidentController::class, 'viewcampus'])->name('president.mycampus');
    Route::get('/president/dashboard/campus/content', [PresidentController::class, 'campusContent'])->name('campus.content');
    Route::post('/president/dashboard/campus/content', [PresidentController::class, 'addContent'])->name('campus.savecontent');
    Route::get('/president/dashboard/campus/content-list', [PresidentController::class, 'viewcontentList'])->name('campus.contentlist');
    Route::delete('/president/dashboard/campus/content-delete/{content}', [PresidentController::class, 'destroyContent'])->name('president.content-delete');
    Route::get('/president/dashboard/content', [SearchController::class, 'searchContentp'])->name('president.search-content');
    Route::get('/president/dashboard/vice_president', [SearchController::class, 'searchVice_president'])->name('president.search-vice_president');
    Route::post('/president/content/{content}/approve', [PresidentController::class, 'approveContent'])->name('president.approve-content');
    Route::post('/president/content/{content}/disapprove', [PresidentController::class, 'disapproveContent'])->name('president.disapprove-content');


    Route::get('president/profile', [PresidentController::class, 'profileedit'])->name('presidentprofile.edit');
    Route::patch('president/profile', [PresidentController::class, 'profileupdate'])->name('presidentprofile.update');
    Route::delete('president/profile', [PresidentController::class, 'destroy'])->name('president-profile.destroy');

    Route::get('president/view-content', [PresidentController::class, 'viewcampusContent'])->name('president.view-content');
    Route::post('president/add-comment/{content}', [PresidentController::class, 'addComment'])->name('president.add-comment');

    Route::get('president/view-vice_president-reports', [PresidentController::class, 'viewReports'])->name('president.view-vice_president-reports');
});


Route::get('test', function () {
    dd(phpinfo());
});


require __DIR__ . '/auth.php';
