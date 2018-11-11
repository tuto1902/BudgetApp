@extends('layouts/app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <form method="GET" id="months-form">
                        <select name="month" id="month" class="form-control" onchange="document.getElementById('months-form').submit()">
                            <option value="Jan {{ $currentYear }}" {{ $currentMonth == 'Jan ' . $currentYear ? 'selected' : '' }}>January</option>
                            <option value="Feb {{ $currentYear }}" {{ $currentMonth == 'Jan ' . $currentYear ? 'selected' : '' }}>February</option>
                            <option value="Mar {{ $currentYear }}" {{ $currentMonth == 'Jan ' . $currentYear ? 'selected' : '' }}>March</option>
                            <option value="Apr {{ $currentYear }}" {{ $currentMonth == 'Apr ' . $currentYear ? 'selected' : '' }}>April</option>
                            <option value="May {{ $currentYear }}" {{ $currentMonth == 'May ' . $currentYear ? 'selected' : '' }}>May</option>
                            <option value="Jun {{ $currentYear }}" {{ $currentMonth == 'Jun ' . $currentYear ? 'selected' : '' }}>June</option>
                            <option value="Jul {{ $currentYear }}" {{ $currentMonth == 'Jul ' . $currentYear ? 'selected' : '' }}>July</option>
                            <option value="Aug {{ $currentYear }}" {{ $currentMonth == 'Aug ' . $currentYear ? 'selected' : '' }}>August</option>
                            <option value="Sep {{ $currentYear }}" {{ $currentMonth == 'Sep ' . $currentYear ? 'selected' : '' }}>September</option>
                            <option value="Oct {{ $currentYear }}" {{ $currentMonth == 'Oct ' . $currentYear ? 'selected' : '' }}>October</option>
                            <option value="Nov {{ $currentYear }}" {{ $currentMonth == 'Nov ' . $currentYear ? 'selected' : '' }}>November</option>
                            <option value="Dec {{ $currentYear }}" {{ $currentMonth == 'Dec ' . $currentYear ? 'selected' : '' }}>December</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                            <td><a href="/transactions/{{ $transaction->id }}">{{ $transaction->description }}</a></td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                <form action="/transactions/{{ $transaction->id }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-xs" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection