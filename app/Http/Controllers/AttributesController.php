<?php

namespace App\Http\Controllers;

use App\AttributeValues;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Attribute;
use Validator;

class AttributesController extends Controller
{
    private $rules = [
        'name' => 'required',
        'values' => 'required',
    ];

    private $messages = [
        'name.required' => 'Поле должно быть заполнено!',
        'values.required' => 'Невозможно создать атрибут без значений!',
        'values.*.distinct' => 'Значения одинаковы!',
        'values.*.filled' => 'Поле должно быть заполнено!',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attributes.index', ['attributes' => Attribute::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Attribute $attribute)
    {

        $rules = $this->rules;
        $rules['values.new.*.name'] = 'distinct|filled';

        $validator = Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $attribute->fill($request->only(['name']));
        $attribute->save();

        foreach ($request->values as $attribute_value_id => $value){

            foreach ($value as $new) {
                $attribute_value = new AttributeValue;
                $attribute_value->attribute_id = $attribute->id;
                $attribute_value->name = $new['name'];
                $attribute_value->save();
            }

        }

        return redirect('/admin/attributes')
            ->with('message-success', 'Атрибут ' . $attribute->name . ' успешно добавлен.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.attributes.edit', ['attribute' => Attribute::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = $this->rules;
        $rules['values.new.*.name'] = 'distinct|filled';
        $rules['values.*.name'] = 'distinct|filled';

        $validator = Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $attribute = Attribute::find($id);
        $attribute->fill($request->only(['name']));
        $attribute->save();

        foreach ($request->values as $attribute_value_id => $value){

            if($attribute_value_id == 'new') {

                foreach ($value as $new) {
                    $attribute_value = new AttributeValue;
                    $attribute_value->attribute_id = $attribute->id;
                    $attribute_value->name = $new['name'];
                    $attribute_value->save();
                }
            } elseif($attribute_value_id == 'delete') {
                foreach ($value as $delete) {
                    $attribute_value = AttributeValue::find($delete);
                    $attribute_value->delete();
                    ProductAttribute::where('attribute_value_id', $delete)->delete();
                }
            } else {
                $attribute_value = AttributeValue::find($attribute_value_id);
                $attribute_value->name = $value['name'];
                $attribute_value->save();
            }

        }

        return redirect('/admin/attributes')
            ->with('message-success', 'Атрибут ' .$attribute->name . ' успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        $attribute->delete();
        $attribute->values()->delete();
        ProductAttribute ::where('attribute_id', $id)->delete();

        return redirect('/admin/attributes')
            ->with('message-success', 'Атрибут ' .$attribute->name . ' успешно удален.');
    }

}
