<div id="newpost-checkout-selection">
    <div class="cart-block_checkout_form_select">
        <select id="checkout-step__region" class="sort_list" name="newpost[region]" onchange="newpostUpdate('region', $(this).val());">
            <option value="">Выберите область</option>
            @foreach($regions as $region)
                <option value="{!! $region->id !!}">{!! $region->name !!}</option>
            @endforeach
        </select>
    </div>

    <div class="cart-block_checkout_form_select">
        <select id="checkout-step__city" class="sort_list" name="newpost[city]" onchange="newpostUpdate('city', $(this).val());">
            <option value="0">Сначала выберите область!</option>
        </select>
    </div>

    <div class="cart-block_checkout_form_select">
        <select id="checkout-step__warehouse" class="sort_list" name="newpost[warehouse]">
            <option value="0">Сначала выберите город!</option>
        </select>
    </div>
</div>

<span class="cart-block_checkout-payment_comment-txt">Оставьте комментарий к заказу, если Вам необходимо выписать счет, укажите это в комментариях</span>

<textarea class="cart-block_checkout_form_textarea" name="message" placeholder="Сообщение"></textarea>

<div class="cart-block_checkout-btn_wrap">
    <button class="cart-block_checkout-btn" type="submit">Оформить заказ</button>
    <a href="/" class="cart-block_checkout-back">Продолжить покупки</a>
</div>