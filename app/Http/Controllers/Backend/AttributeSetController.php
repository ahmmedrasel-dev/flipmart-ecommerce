<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeSet;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeSetController extends Controller
{
    public function index(){
        return view('backend.attribute.attribute', [
            'attributes' => AttributeSet::orderBy('attribute_name', 'asc')->get(),
        ]);
    }

    public function attributeValueView(){
        return view('backend.attribute.attribute-value', [
            'attributeName' => AttributeSet::orderBy('attribute_name', 'asc')->get(),
            'attributevalue' => AttributeValue::with('attributeName')->orderBy('attributeset_id', 'asc')->get(),
        ]);
    }

    public function attributeValueStore(Request $request){
        $attrvalue = new AttributeValue;
        $attrvalue->attributeset_id = $request->attributeName_id;
        $attrvalue->value = $request->attribute_value;
        $attrvalue->save();

        $notification = array(
            'message' => 'Attribute Value Add Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function store(Request $request){

        $request->validate([
            'attribute_name' => 'required',
        ]);

        $attributeName = new AttributeSet;
        $attributeName->attribute_name = $request->attribute_name;
        $attributeName->save();
        $notification = array(
            'message' => 'Attribute Create Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function delete($id, AttributeSet $attributeSet){
        $attributeSet->findOrFail($id)->delete();
        $notification = array(
            'message' => 'Attribute Deleted Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


}
