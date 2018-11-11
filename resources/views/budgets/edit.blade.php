@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Budget
                    </div>
                    <div class="panel-body">
                        <form action="/budgets/{{ $budget->id }}" method="POST">
                            {{ method_field('PUT') }}
                            @include('budgets.form', ['buttonText' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
