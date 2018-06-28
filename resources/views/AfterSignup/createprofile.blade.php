@extends('layouts.main2')
@section('title')
Create-profile | fluidbN
@endsection

@section('content')
<h1>Create your profile to get a business window !!</h1>
{!! Form::open(['route'=>'get-me-in','method'=>'POST','files'=>true,'enctype'=>'multipart/form-data']) !!}  <!-- open(['url' => 'foo/bar'])--  can also be used-->

<div class="form-group">
    {{Form::label('image','Choose profile image')}}
    {{Form::file('image')}}
        </div>
        <div class="form-group">
                
                {{Form::radio('gender','Male',['class'=>'form-control','placeholder'=>''])}} {{Form::label('gender','Male')}}
                {{Form::radio('gender','Female',['class'=>'form-control','placeholder'=>''])}} {{Form::label('gender','Female')}}
                
            </div> 


        <div class="form-group">
{{Form::label('about','A line about you')}}
{{Form::text('about','',['class'=>'form-control','placeholder'=>''])}}
</div>
<div class="form-group">
{{Form::label('designation','Your designation')}}
{{Form::text('designation','',['class'=>'form-control','placeholder'=>''])}}
</div>
<div class="form-group">

{{Form::label('company','Company you work ')}}
{{Form::text('company','',['id'=>'',  'class'=>'form-control','placeholder'=>''])}}
</div>

<div class="form-group">
 {{Form::radio('not_working','1')}} {{Form::label('not_working','Not working yet or a freelancer ')}}
    </div>
{{Form::submit('Get me in',['class'=>'btn btn-primary'])}}

       
     
       {!! Form::close() !!}


@endsection
