<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
class ItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = Item::select('category')->distinct()->get();
        $selectedCategory = $request->query('category');
        $sortBy = $request->query('sortBy');
        $sortDirection = $request->query('sortDirection');
    
        $query = Item::query();
    
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }
    
        if ($sortBy && $sortDirection) {
            $query->orderBy($sortBy, $sortDirection);
        }
    
        $items = $query->paginate(12); // Adjust the pagination limit as needed

        // Fetch two sets of random items for sliders
        $randomItems1 = Item::inRandomOrder()->limit(2)->get();
        $randomItems2 = Item::inRandomOrder()->limit(2)->get();
  
        return view('auth.dashboard', compact('categories', 'items', 'selectedCategory', 'randomItems1', 'randomItems2'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search based on the query
        $searchResults = Item::where('name', 'like', '%'.$query.'%')
                            // ->orWhere('description', 'like', '%'.$query.'%')
                            ->get();

        return view('search_results', ['searchResults' => $searchResults, 'query' => $query]);
    }

    
}
