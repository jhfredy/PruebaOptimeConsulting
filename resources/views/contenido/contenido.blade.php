@extends('principal')
@section('contenido')
    <template v-if="menu==0">
    <h1>Contenido del menú 0</h1>
    </template>

    <template v-if="menu==1">
        {{--  <categoria></categoria>  --}}
    </template>

    <template v-if="menu==2">
        {{--  <articulo></articulo>  --}}
    </template>
 
@endsection