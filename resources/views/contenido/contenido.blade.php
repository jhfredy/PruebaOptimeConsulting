@extends('principal')
@section('contenido')
    <template v-if="menu==0">
    <principal></principal>
    </template>

    <template v-if="menu==1">
        <category></category>
    </template>

    <template v-if="menu==2">
        <product></product>
    </template>
 
@endsection