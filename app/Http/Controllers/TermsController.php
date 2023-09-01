<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchValue = request()->input('searchvalue');

        $termQuery = Term::query();

        if ($searchValue) {
            $termQuery->where(function ($query) use ($searchValue) {
                $query->where('term', 'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%')
                    ->orWhere('termdays', 'like', '%' . $searchValue . '%');
            });
        }

        $terms = $termQuery->paginate(15);

        return view('terms.index', compact('terms', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTermRequest $request)
    {
        $data = $request->validated();

        $term = new Term();
        $term->fill($data)->save();

        return redirect('/terms')->with('success', 'New Term (' . $term->term . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Term $term
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Term $term)
    {
        return view('terms.show', compact('term'));
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Term $term
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Term $term)
    {
        return view('terms.edit', compact('term'));
    }

    /**
     * Update the specified term resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermRequest  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        $data = $request->validated();

        $term->update($data);

        return redirect('/terms')->with('success', 'Term (' . $term->term . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Term $term
     */
    public function destroy(Term $term)
    {
        $term->delete();

        return redirect('/terms')->with('success', 'Term ('.$term->term.') has been deleted!!');
    }
}
