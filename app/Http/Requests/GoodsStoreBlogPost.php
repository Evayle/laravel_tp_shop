<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsStoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
        'goods_name' => 'required',
        'goods_describe' => 'required',
        'goods_store' => 'required|regex:/^\d{1,10}$/',
        'goods_price' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
        'goods_num' => 'required|regex:/^\d{1,10}$/',
        'goods_plot' => 'required',
        'pics_url' => 'required',
        'imgs_url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'goods_name.required' => '商品名称必填',
            'goods_describe.required' => '商品描述必填',
            'goods_store.required' => '商品库存必填',
            'goods_store.regex' => '商品库存格式不正确',
            'goods_price.required' => '商品价格必填',
            'goods_price.regex' => '商品价格格式不正确',
            'goods_num.required' => '商品数量必填',
            'goods_num.regex' => '商品数量格式不正确',
            'goods_plot.required' => '商品封面图必选',
            'pics_url.required' => '商品缩略图必选',
            'imgs_url.required' => '商品详情图必选',
        ];
    }
}
