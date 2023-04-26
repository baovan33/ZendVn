<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{
    use StorageImageTrait;
    public function index() {
        $products = Product::latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        $getCategory = getCategory($categories);
        return view('admin.product.create', compact('getCategory') );
    }

    public function postCreate(Request $request) {
        try {
            DB::beginTransaction();
            // Insert data to product
            $dataProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
            ];

            $dataProductFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if ( !empty($dataProductFeatureImage) ) {
                $dataProduct['feature_image_path'] =  $dataProductFeatureImage['file_path'];
                $dataProduct['feature_image_name'] =  $dataProductFeatureImage['file_name'];
            }
            $product = Product::create($dataProduct);

            //Insert image to product_image
            if( $request->hasFile('image_path') ){
                foreach ($request->image_path as $fileName) {
                    $dataImageDetail = $this->storageTraitUploadMultiple( $fileName, 'product');
                    $product->images()->create([
                        'product_id' => $product->id,
                        'image_path' => $dataImageDetail['file_path'],
                        'image_name' => $dataImageDetail['file_name'],
                    ]);
                }
            }
            //Insert data to product_tag & tag
            $json = $request->tags;
            $tags = json_decode($json[0]);
            if( !empty($tags) ) {
                foreach ($tags as $tag) {
                    //Insert data to tag
                    $tagInstance = Tag::firstOrCreate([
                        "name" => $tag->value,
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            //Insert data to product_tag
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('product.index')->with('msg','Thêm thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'line: ' . $exception->getLine() );
        };

    }

    public function edit(Product $product) {
        $categories = Category::all();
        $getCategory = getCategory($categories);
        return view('admin.product.edit', compact('getCategory','product', ) );
    }

    public function update(Request $request, Product $product) {

       try {
           DB::beginTransaction();
            // Update data to product
            $dataProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
            ];

            $dataProductFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            $pathFeatureImage = $product->feature_image_path;

            if ( !empty($dataProductFeatureImage) ) {
                if( file_exists(public_path($pathFeatureImage))  ) {
                   unlink(public_path($pathFeatureImage));
                }
                $dataProduct['feature_image_path'] =  $dataProductFeatureImage['file_path'];
                $dataProduct['feature_image_name'] =  $dataProductFeatureImage['file_name'];
            }
            else {
                $dataProduct['feature_image_path'] = $product->feature_image_path;
                $dataProduct['feature_image_name'] =  $product->feature_image_name;
            }
           $product->update($dataProduct);

            //Update image to product_image
            $listPathImg = [];
            $pathImagePath = $product->images;
            foreach ($pathImagePath as $item) {
                $listPathImg[] = $item->image_path;
            }
            if( $request->hasFile('image_path') ){

                foreach( $listPathImg as $pathImg ) {
                    if( file_exists(public_path($pathImg))  ) {
                        unlink(public_path($pathImg));
                    }
                }

                foreach ( $request->image_path as $fileName ) {
                    $dataImageDetail = $this->storageTraitUploadMultiple( $fileName, 'product');
                    $product->images()->update([
                        'product_id' => $product->id,
                        'image_path' => $dataImageDetail['file_path'],
                        'image_name' => $dataImageDetail['file_name'],
                    ]);
                }
            }
            //Update data to product_tag & tag
            $tags = $request->tags;
            if( !empty($tags) ) {
                foreach ($tags as $tag) {
                    //Insert data to tag
                    $tagInstance = Tag::firstOrCreate([
                        "name" => $tag,
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            //Insert data to product_tag
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index')->with('msg','Update thành công');

        } catch (\Exception $exception) {
           DB::rollBack();
           Log::error('Message: ' . $exception->getMessage() . 'line: ' . $exception->getLine() );
        }

    }
}
