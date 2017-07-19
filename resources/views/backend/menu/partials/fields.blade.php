<div class="form-group">
  	<label>Name</label>
  	<input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ isset($menu) ? $menu->name : old('name')}}">
  	<span class="help-block"></span>
</div>
@if(config('menu.can_add'))
<div class="form-group">
  	<label>Postion</label>
  	{!! Form::select('position', config('menu.position'), isset($menu) ? $menu->position : old('position'), ['class' => 'form-control']) !!}
  	<span class="help-block"></span>
</div>
@endif