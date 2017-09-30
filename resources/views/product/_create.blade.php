{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter the name of the product']) }}
{{ Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Enter the quantity of the product']) }}
{{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Enter the price of the product']) }}
{{ Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'Enter the discount of the product or empty']) }}
{{ Form::select('group_id', $group, ['class' => 'form-control']) }}
{{ Form::submit($textProductButton, ['class' => 'btn btn-primary']) }}