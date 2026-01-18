<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Front
Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::get('/project', [App\Http\Controllers\HomepageController::class, 'project'])->name('project');
// Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');
// Route::get('/cars', [App\Http\Controllers\CarsController::class, 'index'])->name('cars');
// Route::get('/car/{id}', [App\Http\Controllers\CarsController::class, 'car'])->name('car');
// Route::get('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'singleProject'])->name('projects-single');
// Route::post('/contact/new', [App\Http\Controllers\ContactController::class, 'contactSend'])->name('new-contact');
// Route::post('/service/reservation/update', [App\Http\Controllers\ServiceController::class, 'save'])->name('service-reservation.update');
// Route::get('/auto-rental', [App\Http\Controllers\AutoRentalController::class, 'search'])->name('auto-rental.search');
// Route::get('/auto-rental/car/{id}', [App\Http\Controllers\AutoRentalController::class, 'car'])->name('auto-rental.car');
// Route::get('/service-limusine', [App\Http\Controllers\ServiceController::class, 'serviceLimusine'])->name('service-limusine');
// Route::get('/auto-service-reservation', [App\Http\Controllers\ServiceController::class, 'autoServiceReservation'])->name('auto-service.reservation');
// Route::post('/set/locale', [App\Http\Controllers\HomepageController::class, 'setLocale'])->name('locale.set');
// Route::get('/privacy-policy', [App\Http\Controllers\HomepageController::class, 'privacyPolicy'])->name('privacy-policy');

// Back
Route::group(['prefix' => '', 'middleware' => ['auth']], function ($user) {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{website}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/revenue/api/{year}/{website}', [App\Http\Controllers\FactureController::class, 'revenueByYear'])->name('revenue.byYear');

    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile-edit');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profileUpdate'])->name('profile-update');

    // Team Members
    Route::get('/team-members', [App\Http\Controllers\TeamMemberController::class, 'index'])->name('team-members');
    Route::get('/team-members/create', [App\Http\Controllers\TeamMemberController::class, 'create'])->name('team-member-create');
    Route::get('/team-members/edit/{id}', [App\Http\Controllers\TeamMemberController::class, 'edit'])->name('team-member-edit');
    Route::post('/team-members/create/new', [App\Http\Controllers\TeamMemberController::class, 'createNewMember'])->name('team-member-create-new');
    Route::post('/team-members/create/update', [App\Http\Controllers\TeamMemberController::class, 'updateMember'])->name('team-member-update');
    Route::post('/team-members/delete', [App\Http\Controllers\TeamMemberController::class, 'delete'])->name('team-member-delete');

    // Roles
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');

    // Users
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users-create');
    Route::get('/users/edit/{user_id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users-edit');
    Route::get('/users/view/{user_id}', [App\Http\Controllers\UserController::class, 'view'])->name('users-view');
    Route::post('/users/create/new', [App\Http\Controllers\UserController::class, 'update'])->name('users-create-new');
    Route::post('/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users-delete');

    // Contacts
    Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
    Route::get('/contacts/view/{contact_id}', [App\Http\Controllers\ContactController::class, 'view'])->name('contacts-view');

    // Blogs
    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
    Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs-create');
    Route::get('/blogs/edit/{id}', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs-edit');
    Route::post('/blogs/update', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs-update');
    Route::post('/blogs/delete', [App\Http\Controllers\BlogController::class, 'delete'])->name('blogs-delete');

    // Blog Categories
    Route::get('/blogs/categories', [App\Http\Controllers\BlogsCategoriesController::class, 'index'])->name('blogs-categories');
    Route::get('/blogs/categories/create', [App\Http\Controllers\BlogsCategoriesController::class, 'create'])->name('blogs-categories-create');
    Route::get('/blogs/categories/edit/{id}', [App\Http\Controllers\BlogsCategoriesController::class, 'edit'])->name('blogs-categories-edit');
    Route::post('/blogs/categories/update', [App\Http\Controllers\BlogsCategoriesController::class, 'update'])->name('blogs-categories-update');
    Route::post('/blogs/categories/delete', [App\Http\Controllers\BlogsCategoriesController::class, 'delete'])->name('blogs-categories-delete');

    // Projects
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('projects-create');
    Route::get('/projects/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('projects-edit');
    Route::post('/projects/update', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects-update');
    Route::post('/projects/delete', [App\Http\Controllers\ProjectController::class, 'delete'])->name('projects-delete');

    // Activities
    Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');

    // Jobs
    Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
    Route::get('/jobs/create', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/update', [App\Http\Controllers\JobController::class, 'update'])->name('jobs.create.update');
    Route::post('/jobs/delete', [App\Http\Controllers\JobController::class, 'delete'])->name('jobs.delete');
    Route::get('/jobs/edit/{id}', [App\Http\Controllers\JobController::class, 'edit'])->name('jobs.edit');

    // Jobs categories
    Route::get('/jobs/categories', [App\Http\Controllers\JobController::class, 'categories'])->name('jobs.categories');
    Route::get('/jobs/categories/create', [App\Http\Controllers\JobController::class, 'categoriesCreate'])->name('jobs.categories.create');
    Route::post('/jobs/categories/update', [App\Http\Controllers\JobController::class, 'categoriesUpdate'])->name('jobs.categories.update');
    Route::post('/jobs/categories/delete', [App\Http\Controllers\JobController::class, 'categoriesDelete'])->name('jobs.categories.delete');
    Route::get('/jobs/categories/edit/{id}', [App\Http\Controllers\JobController::class, 'categoriesEdit'])->name('jobs.categories.edit');

    // Testimonials
    Route::get('/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials');
    Route::get('/testimonials/create', [App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
    Route::get('/testimonials/edit/{id}', [App\Http\Controllers\TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::post('/testimonials/update', [App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::post('/testimonials/delete', [App\Http\Controllers\TestimonialController::class, 'delete'])->name('testimonials.delete');

    // World Leading Brands
    Route::get('/wlb', [App\Http\Controllers\WorldLeadingBrandController::class, 'index'])->name('wlb');
    Route::get('/wlb/create', [App\Http\Controllers\WorldLeadingBrandController::class, 'create'])->name('wlb.create');
    Route::get('/wlb/edit/{id}', [App\Http\Controllers\WorldLeadingBrandController::class, 'edit'])->name('wlb.edit');
    Route::post('/wlb/update', [App\Http\Controllers\WorldLeadingBrandController::class, 'update'])->name('wlb.update');
    Route::post('/wlb/delete', [App\Http\Controllers\WorldLeadingBrandController::class, 'delete'])->name('wlb.delete');

    // Buy Cars Categories
    Route::get('/buy/cars/categories', [App\Http\Controllers\BuyCarsController::class, 'categories'])->name('buy-cars.categories');
    Route::get('/buy/cars/categories/create', [App\Http\Controllers\BuyCarsController::class, 'categoriesCreate'])->name('buy-cars.categories.create');
    Route::get('/buy/cars/categories/edit/{id}', [App\Http\Controllers\BuyCarsController::class, 'categoriesEdit'])->name('buy-cars.categories.edit');
    Route::post('/buy/cars/categories/update', [App\Http\Controllers\BuyCarsController::class, 'categoriesUpdate'])->name('buy-cars.categories.update');
    Route::post('/buy/cars/categories/delete', [App\Http\Controllers\BuyCarsController::class, 'deleteCategoryWithID'])->name('buy-cars.categories.delete');

    // Buy Cars Mark
    Route::get('/buy/cars/marks', [App\Http\Controllers\BuyCarsController::class, 'marks'])->name('buy-cars.marks');
    Route::get('/buy/cars/marks/create', [App\Http\Controllers\BuyCarsController::class, 'marksCreate'])->name('buy-cars.marks.create');
    Route::get('/buy/cars/marks/edit/{id}', [App\Http\Controllers\BuyCarsController::class, 'marksEdit'])->name('buy-cars.marks.edit');
    Route::post('/buy/cars/marks/update', [App\Http\Controllers\BuyCarsController::class, 'updateMark'])->name('buy-cars.marks.update');
    Route::post('/buy/cars/marks/delete', [App\Http\Controllers\BuyCarsController::class, 'deleteMarkWithID'])->name('buy-cars.marks.delete');

    // Buy Cars Models
    Route::get('/buy/cars/models', [App\Http\Controllers\BuyCarsController::class, 'models'])->name('buy-cars.models');
    Route::get('/buy/cars/models/create', [App\Http\Controllers\BuyCarsController::class, 'modelsCreate'])->name('buy-cars.models.create');
    Route::post('/buy/cars/models/update', [App\Http\Controllers\BuyCarsController::class, 'updateModel'])->name('buy-cars.models.update');
    Route::get('/buy/cars/models/edit/{id}', [App\Http\Controllers\BuyCarsController::class, 'modelsEdit'])->name('buy-cars.models.edit');
    Route::post('/buy/cars/models/delete', [App\Http\Controllers\BuyCarsController::class, 'deleteModelWithID'])->name('buy-cars.models.delete');

    // Buy Cars
    Route::get('/buy/cars', [App\Http\Controllers\BuyCarsController::class, 'cars'])->name('buy-cars.cars');
    Route::get('/buy/cars/create', [App\Http\Controllers\BuyCarsController::class, 'createCar'])->name('buy-cars.cars.create');
    Route::post('/buy/cars/update', [App\Http\Controllers\BuyCarsController::class, 'updateCars'])->name('buy-cars.cars.update');
    Route::get('/buy/cars/edit/{id}', [App\Http\Controllers\BuyCarsController::class, 'buyCarsEdit'])->name('buy-cars.edit');
    Route::post('/buy/cars/delete', [App\Http\Controllers\BuyCarsController::class, 'buyCarsDelete'])->name('buy-cars.delete');

    // Auto Rental
    Route::get('/auto-rental', [App\Http\Controllers\AutoRentalController::class, 'index'])->name('auto-rental.index');
    Route::get('/auto-rental/create', [App\Http\Controllers\AutoRentalController::class, 'create'])->name('auto-rental.create');
    Route::post('/auto-rental/update', [App\Http\Controllers\AutoRentalController::class, 'update'])->name('auto-rental.update');
    Route::get('/auto-rental/edit/{id}', [App\Http\Controllers\AutoRentalController::class, 'edit'])->name('auto-rental.edit');
    Route::post('/auto-rental/delete', [App\Http\Controllers\AutoRentalController::class, 'delete'])->name('auto-rental.delete');

    // Reservations
    Route::get('/reservations', [App\Http\Controllers\ServiceController::class, 'index'])->name('reservations.index');

    // Theme
    Route::get('/pages', [App\Http\Controllers\ThemeController::class, 'pages'])->name('pages');

    // Costs Categories
    Route::get('/costs/categories', [App\Http\Controllers\CostController::class, 'indexCategory'])->name('costs.categories');
    Route::get('/costs/categories/create', [App\Http\Controllers\CostController::class, 'createCategory'])->name('costs.categories.create');
    Route::get('/costs/categories/edit/{id}', [App\Http\Controllers\CostController::class, 'editCategory'])->name('costs.categories.edit');
    Route::post('/costs/categories/update', [App\Http\Controllers\CostController::class, 'updateCategory'])->name('costs.categories.update');
    Route::post('/costs/categories/destroy', [App\Http\Controllers\CostController::class, 'destroyCategory'])->name('costs.categories.destroy');

    // Costs Sub Categories
    Route::get('/costs/sub/categories', [App\Http\Controllers\CostController::class, 'indexCategorySub'])->name('costs.sub.categories');
    Route::get('/costs/sub/categories/create', [App\Http\Controllers\CostController::class, 'createCategorySub'])->name('costs.sub.categories.create');
    Route::get('/costs/sub/categories/edit/{id}', [App\Http\Controllers\CostController::class, 'editCategorySub'])->name('costs.sub.categories.edit');
    Route::post('/costs/sub/categories/update', [App\Http\Controllers\CostController::class, 'updateCategorySub'])->name('costs.sub.categories.update');
    Route::post('/costs/sub/categories/destroy', [App\Http\Controllers\CostController::class, 'destroyCategorySub'])->name('costs.sub.categories.destroy');
    Route::post('/api/costs/sub/categories/{website}', [App\Http\Controllers\CostController::class, 'categoriesSubApi'])->name('costs.sub.categories.api');

    //Offers 
    Route::get('/offres/{website}', [App\Http\Controllers\OfferAnnualController::class, 'index'])->name('offres');
    Route::get('/offres/{website}/create', [App\Http\Controllers\OfferAnnualController::class, 'create'])->name('offres.create');
    Route::get('/offres/edit/{id}', [App\Http\Controllers\OfferAnnualController::class, 'edit'])->name('offres.edit');
    Route::post('/offres/{website}/update', [App\Http\Controllers\OfferAnnualController::class, 'update'])->name('offres.update');
    Route::post('/offres/destory', [App\Http\Controllers\OfferAnnualController::class, 'destroy'])->name('offres.destroy');
    Route::post('/offres/preview', [App\Http\Controllers\OfferAnnualController::class, 'preview'])->name('offres.preview');
    Route::post('/offres/download', [App\Http\Controllers\OfferAnnualController::class, 'download'])->name('offres.download');

    // Bon Livrasion
    Route::get('/bon/livraison/{website}', [App\Http\Controllers\BonLivrasionController::class, 'index'])->name('bonLivrasion');
    Route::get('/bon/livraison/{website}/create', [App\Http\Controllers\BonLivrasionController::class, 'create'])->name('bonLivrasion.create');
    Route::post('/bon/livraison/{website}/update', [App\Http\Controllers\BonLivrasionController::class, 'update'])->name('bonLivrasion.update');
    Route::post('/bon/livraison/destory', [App\Http\Controllers\BonLivrasionController::class, 'destroy'])->name('bonLivrasion.destroy');
    Route::get('/bon/livraison/edit/{id}', [App\Http\Controllers\BonLivrasionController::class, 'edit'])->name('bonLivrasion.edit');
    Route::post('/bon/livraison/preview', [App\Http\Controllers\BonLivrasionController::class, 'preview'])->name('bonLivrasion.preview');
    Route::post('/bon/livraison/download', [App\Http\Controllers\BonLivrasionController::class, 'download'])->name('bonLivrasion.download');

    // Costs
    Route::get('/costs', [App\Http\Controllers\CostController::class, 'index'])->name('costs');
    Route::get('/costs/create', [App\Http\Controllers\CostController::class, 'create'])->name('costs.create');
    Route::get('/costs/edit/{id}', [App\Http\Controllers\CostController::class, 'edit'])->name('costs.edit');
    Route::post('/costs/update', [App\Http\Controllers\CostController::class, 'update'])->name('costs.update');
    Route::post('/costs/destroy', [App\Http\Controllers\CostController::class, 'destroy'])->name('costs.destroy');
    Route::get('/costs/api/{year}/{website}', [App\Http\Controllers\CostController::class, 'getCostsByYear'])->name('costs.byYear');

    // Factures
    Route::get('/factures/{website}', [App\Http\Controllers\FactureController::class, 'index'])->name('factures');
    Route::post('/factures/preview', [App\Http\Controllers\FactureController::class, 'preview'])->name('factures.preview');
    Route::post('/factures/download', [App\Http\Controllers\FactureController::class, 'download'])->name('factures.download');
    Route::post('/factures/print', [App\Http\Controllers\FactureController::class, 'print'])->name('factures.print');
    Route::post('/factures/duplicate', [App\Http\Controllers\FactureController::class, 'duplicate'])->name('factures.duplicate');

    // Factures
    Route::get('/factures/create/{website}', [App\Http\Controllers\FactureController::class, 'create'])->name('factures.create');
    Route::post('/factures/update/{website}', [App\Http\Controllers\FactureController::class, 'update'])->name('factures.update');
    Route::post('/factures/delete', [App\Http\Controllers\FactureController::class, 'delete'])->name('factures.delete');
    Route::get('/factures/edit/{id}/{website}', [App\Http\Controllers\FactureController::class, 'edit'])->name('factures.edit');
    Route::post('/factures/email/send', [App\Http\Controllers\FactureController::class, 'emailSend'])->name('factures.email.send');
    
    // Facture Email History
    Route::get('/factures/{factureId}/email-history/{website}', [App\Http\Controllers\FactureEmailHistoryController::class, 'show'])->name('factures.email-history.show');
    Route::post('/factures/email-history/api', [App\Http\Controllers\FactureEmailHistoryController::class, 'api'])->name('factures.email-history.api');

    // Clients
    Route::get('/factures/clients/all/{website}', [App\Http\Controllers\UserController::class, 'clients'])->name('factures.clients');
    Route::get('/factures/clients/create/{website}', [App\Http\Controllers\UserController::class, 'clientsCreate'])->name('factures.clients.create');
    Route::post('/factures/clients/update/{website}', [App\Http\Controllers\UserController::class, 'clientsUpdate'])->name('factures.clients.update');
    Route::get('/factures/clients/edit/{id}/{website}', [App\Http\Controllers\UserController::class, 'clientsEdit'])->name('factures.clients.edit');
    Route::post('/factures/clients/delete', [App\Http\Controllers\UserController::class, 'clientsDelete'])->name('factures.clients.delete');

    // Offers
    Route::get('/offers', [App\Http\Controllers\FactureController::class, 'offersList'])->name('offers');
    Route::get('/offers/create', [App\Http\Controllers\FactureController::class, 'offersCreate'])->name('offers.create');
    Route::get('/offers/edit/{id}', [App\Http\Controllers\FactureController::class, 'offersEdit'])->name('offers.edit');

    // Clients cars
    Route::get('/clients/cars', [App\Http\Controllers\ClientCarController::class, 'index'])->name('clients.cars');
    Route::get('/clients/cars/create', [App\Http\Controllers\ClientCarController::class, 'create'])->name('clients.cars.create');
    Route::post('/clients/cars/update', [App\Http\Controllers\ClientCarController::class, 'update'])->name('clients.cars.update');
    Route::get('/clients/cars/edit/{id}', [App\Http\Controllers\ClientCarController::class, 'edit'])->name('clients.cars.edit');
    Route::post('/clients/cars/delete', [App\Http\Controllers\ClientCarController::class, 'destroy'])->name('clients.cars.destroy');
    Route::get('/clients/cars/{id}', [App\Http\Controllers\ClientCarController::class, 'carsByClient'])->name('client.cars');

    //Raports Api
    Route::post('/rapports/api', [App\Http\Controllers\DashboardController::class, 'facturesRaports'])->name('rapports.factures');
    Route::post('/raports/factures/preview', [App\Http\Controllers\DashboardController::class, 'facturesRaportsPreview'])->name('rapports.factures.preview');
    Route::post('/raports/factures/download', [App\Http\Controllers\DashboardController::class, 'facturesRaportsDownload'])->name('rapports.factures.download');
    Route::get('/raports/factures/{website}', [App\Http\Controllers\FactureController::class, 'facturesRaportsByWebsite'])->name('rapports.factures.website');
    Route::post('/raports/factures/download/excel', [App\Http\Controllers\FactureController::class, 'generateAndDownload'])->name('rapports.factures.excel');
});

