<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function add(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'makeOrder'=> 'required|string|max:255',
            'vat' => 'required|int',
        ]);

        $oCategory = new ProductCategory;
        $oCategory->sName = $validatedData['name'];
        $oCategory->sMakeOrder = $validatedData['makeOrder'];
        $oCategory->bActive = (bool) $oRequest->active;
        $oCategory->iVatId = $validatedData['vat'];
        $oCategory->save();

        return redirect('/inventory');
    }

    public function edit(Request $oRequest, $id)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'makeOrder'=> 'required|string|max:255',
            'vat' => 'required|int',
        ]);

        $oCategory = ProductCategory::where('id', $id)->first();
        $oCategory->sName = $validatedData['name'];
        $oCategory->sMakeOrder = $validatedData['makeOrder'];
        $oCategory->bActive = (bool) $oRequest->active;
        $oCategory->iVatId = $validatedData['vat'];
        $oCategory->save();

        flash('Category ' . $oCategory->sName . ' saved')->success();
        return redirect('/inventory');
    }

    public function delete($id)
    {
        $oCategory = ProductCategory::where('id', $id)->first();
        $oProducts = $oCategory->products()->get();
        foreach ($oProducts as $oProduct) {
            $oProduct->delete();
        }
        $oCategory->delete();

        return redirect('/inventory');
    }
}
