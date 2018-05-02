@include('mage2-ecommerce::forms.text',[
    'name' => 'name',
    'label' => 'Имя',
    'attributes' => [
        'class' => 'form-control',
        'lang' => true
    ]
])

{{--@include('mage2-ecommerce::forms.text',[--}}
    {{--'name' => 'icon',--}}
    {{--'label' => 'Буква клавиши',--}}
    {{--'attributes' => [--}}
        {{--'class' => 'form-control',--}}
        {{--'placeholder' => 'Например Н - новый, А - акция, ...'--}}
    {{--]--}}
{{--])--}}

@include('mage2-ecommerce::forms.text',[
    'name' => 'color',
    'label' => 'Цвет кнопки',
    'attributes' => [
        'class' => 'form-control',
        'placeholder' => 'Например green, red, blue, ...'
    ]
])
