@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List task') }}</div>

                <div class="card-body">
                    @if(!empty($taskData))
                    <table >
                        <tr style=" border-bottom: 2px solid rgba(0,0,0,.125);">
                            <th>Title

                            </th>
                            <th>Description

                            </th>
                        </tr>
                        @foreach($taskData as $task)
                        <tr style=" border-bottom: 1px solid rgba(0,0,0,.125);">
                            <td>
                                {{ $task->title }}

                            </td>
                            <td>                                {{ $task->description }}


                            </td>
                        </tr>
                            @endforeach
                    </table>
                        @else
                    <p>No task available</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
