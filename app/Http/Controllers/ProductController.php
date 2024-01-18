<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(Request $request) {
        $validated = $request->validate([
                'name'  => 'required',
                'price' => 'required',
                'img'   => 'required',
            ]);

        $file = $request->file('img');
        $filename = "img_" . Str::random(16) . ".jpg";
        $path = $file->storeAs('products', $filename, 'public');

        $validated['img'] = $path;

        Product::create($validated);

        return redirect('/dashboard/foods');
    }

    public function update(Request $request, $id) {

        $thumbnail = $request->old_thumbnail;

        if (isset($request->img)) {
            $file = $request->file('img');
            $filename = "img_" . Str::random(16) . ".jpg";
            $path = $file->storeAs('products', $filename, 'public');

            Storage::delete('public/' . $request->old_thumbnail);

            $thumbnail = $path;
        }

        Product::find($id)
               ->update([
                    'name'  => $request->name,
                    'price' => $request->price,
                    'img'   => $thumbnail,
                ]);

        return redirect('/dashboard/foods');
    }

    public function delete($id) {
        $food = Product::find($id);

        Storage::delete('public/' . $food->img);
        Product::find($id)->delete();

        return redirect('/dashboard/foods');
    }
}
