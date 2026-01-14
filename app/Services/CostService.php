<?php

namespace App\Services;
use App\Models\Costs;
use App\Models\CostCategory;
use App\Models\SubCategory;
use App\Services\ImageService;
use DB;

class CostService{

    public function costsByYear($year, $website = null){
        return response()->json([
            'costsByMonths' => $this->getCostsByMonths($year, $website),
            'allCostByYear' => $this->getAllCostByYear($year, $website),
            'website' => $website,
        ]);
    }

    public function getCategories(){
        $categories = CostCategory::orderBy('created_at', 'desc')->get();
        return $categories;
    }

    public function getCostsByMonths($year, $website = null){
        // Set MySQL locale to French
        DB::statement("SET lc_time_names = 'fr_FR';");

        $monthlyCosts = Costs::select(
            DB::raw('MONTH(payed_date) as month_number'),
            DB::raw('MONTHNAME(payed_date) as month_name'),
            DB::raw('SUM(total_price) as total_cost')
        )
        ->whereYear('payed_date', $year)
        ->where('website', $website)
        ->groupBy(DB::raw('YEAR(payed_date)'), DB::raw('MONTH(payed_date)'), DB::raw('MONTHNAME(payed_date)'))
        ->orderBy(DB::raw('MONTH(payed_date)'))
        ->get();

        return $monthlyCosts;
    }

    public function getAllCostByYear($year, $website = null){
        // Query to get the total cost for the entire year
        $totalCost = Costs::whereYear('payed_date', $year)
        ->where('website', $website)
        ->sum('total_price');

        return $totalCost;
    }

    public function getCosts(){
        $costs = Costs::with(['categoryAtached'])->orderBy('created_at', 'desc')->get();
        return $costs;
    }

    public function findCostById($id){
        $cost = Costs::where('id', $id)->first();
        return $cost;
    }

    public function getEdit($id){
        return view('costs.edit')->with([
            'cost' => $this->findCostById($id),
            'categories' => $this->getCategories()
        ]);
    }

    public function getIndex(){
        return view('costs.index')->with([
            'costs' => $this->getCosts(),
        ]);
    }

    public function getCreate(){
        return view('costs.create')->with([
            'categories' => $this->getCategories()
        ]); 
    }

    public function getDestroy($request){
        $imageService = new ImageService();
        $cost = Costs::find($request->delete_id);
        $path = 'back/files/dépenses/'.$cost->file;
        $delete = $imageService->delete($path);
        $status = $cost->delete();

        if($status > 0 ){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getUpdate($request){
        $imageService = new ImageService();
        
        $fields = [
            'catgory_id' => $request->category,
            'website'=> "gvacars",
            'total_price' => $request->total_price,
            'payed_date' => $request->payed_date,
            'status' => 0,
            'sub_catgory_id' => $request->subcategory,
            'mode_payment' => $request->mode_payment,
            'observations' => $request->observations,
            'description' => $request->description,
        ];

        if($request->type_form == 'create'){
            $cost = new Costs();
            $create = $cost->create($fields);

            if(isset($request->file)){
                // Validate the request
                $request->validate([
                    'file' => 'required|file|max:10240', // 10240 KB = 10 MB
                ]);
                $name = $imageService->getFileName($request->file, $create);
                $create->update([
                    'file' => $name,
                ]);
                $imageService->save($request->file, $create, "back/files/dépenses");
            }

           if($create){
            return redirect()->back()->with(['success' => 'Création réussie !']);
           }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
           }
        }

        if($request->type_form == 'edit'){
            $cost = Costs::find($request->id);

            if(isset($request->file)){
                // Validate the request
                $request->validate([
                    'file' => 'required|file|max:10240', // 10240 KB = 10 MB
                ]);
                $path = 'back/files/dépenses/'.$cost->file;
                $delete = $imageService->delete($path);
                $name = $imageService->getFileName($request->file, $cost);
                $fields['file'] = $name;
                $imageService->save($request->file, $cost, "back/files/dépenses");
            }

            $update = $cost->update($fields);

           if($update > 0){
            return redirect()->back()->with(['success' => 'Création réussie !']);
           }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
           }
        }
        return view('costs.create'); 
    }

    // Categories

    public function costCategories(){
        $categories = CostCategory::orderBy('created_at', 'desc')->get();
        return $categories;
    }

    public function getIndexCategory(){
        return view('costs.categories.index')->with([
            'categories' => $this->costCategories(),
        ]);
    }

    public function findCategoryById($id){
        $category = CostCategory::where('id', $id)->first();
        return $category;
    }

    public function getCreateCategory(){
        return view('costs.categories.create');
    }

    public function getEditCategory($id){
        return view('costs.categories.edit')->with([
            'category' => $this->findCategoryById($id)
        ]);
    }

    public function getUpdateCategory($request){
        if($request->type_form == 'create'){
            $cost = new CostCategory();
            $create = $cost->create($request->all());

            if($create){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type_form == 'edit'){
            $cost = CostCategory::find($request->id);
            $update = $cost->update($request->all());

            if($update > 0){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }
    }

    public function getDestroyCategory($request){
        $cost = CostCategory::find($request->category_id);
        $status = $cost->delete();

        if($status > 0 ){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    // Sub
    public function costCategoriesSub(){
        $categories = SubCategory::orderBy('created_at', 'desc')->get();
        return $categories;
    }

    public function getIndexCategorySub(){
        return view('costs.sub-categories.index')->with([
            'subcategories' => $this->costCategoriesSub(),
        ]);
    }

    public function findSubCategoryById($id){
        $category = SubCategory::where('id', $id)->first();
        return $category;
    }

    public function getCreateCategorySub(){
        return view('costs.sub-categories.create')->with([
            'categories' => $this->costCategories(),
        ]);
    }

    public function getEditCategorySub($id){
        return view('costs.sub-categories.edit')->with([
            'subcategory' => $this->findSubCategoryById($id),
            'categories' => $this->costCategories(),
        ]);
    }

    public function getUpdateCategorySub($request){
        if($request->type_form == 'create'){
            $cost = new SubCategory();
            $create = $cost->create($request->all());

            if($create){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type_form == 'edit'){
            $cost = SubCategory::find($request->id);
            $update = $cost->update($request->all());

            if($update > 0){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }
    }

    public function getDestroyCategorySub($request){
        $cost = SubCategory::find($request->subcategory_id);
        $status = $cost->delete();

        if($status > 0 ){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getSubCategoriesByCategory($category_id){
        $categories = SubCategory::where('catgory_id', $category_id)
        ->get();

        return $categories;
    }

    public function getCategoriesSubApi($request, $website){
        return response()->json([
            "categories" => $this->getSubCategoriesByCategory($request->category_id)
        ]);
    }

    public function getCostsPricesByYear($website) {
        $currentYear = now()->year;
    
        $costs = Costs::whereNull('deleted_at')
            ->where('website', $website)
            ->whereYear('payed_date', $currentYear)
            ->groupBy(DB::raw('MONTH(payed_date)'))
            ->selectRaw('MONTH(payed_date) as month, SUM(total_price) as total')
            ->get()
            ->keyBy('month');
    
        $monthlySums = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $total = $costs->has($month) ? number_format($costs->get($month)->total, 2, '.', '') : '0.00';
            $monthlySums->push([
                'month' => $month,
                'total' => $total ?? '0.00'
            ]);
        }
    
        return $monthlySums;
    }
}