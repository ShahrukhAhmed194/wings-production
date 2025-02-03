@php
$column = $column ?? config('switcher.default_column');
$id = $id ?? $data->id;
$status = $data[$column];
@endphp

<label class="switcher_switch"><input onchange="changeSwitcherSwitch('{{$table}}', '{{$column}}', '{{$id}}')" type="checkbox" {{$status ? 'checked' : ''}}><span class="switcher_slider switcher_round"></span></label>
