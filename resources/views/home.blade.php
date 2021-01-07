@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of permits</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 <!-- <a href="/questionnaires/create" class="btn btn-dark">Create new questionnaire</a>-->
                  <a href="/metallic/index" class="btn btn-dark">Metallic</a>
                  <a href="/nonmetallic/index" class="btn btn-dark">Non-Metallic</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
