@extends('layouts.app')

@section('page_header')
    <header>
        <div class="container-flid full-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center seo">All Advertisements</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <main>
        <div class="container main-container">
            <div class="row">
                @include('includes.left_bar')

                <section class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center mid-section">
                    @include('includes.advanced_search')

                    @include('includes.advertisment_list')

                    <div class="row product-list-item pagination-holder">
                        {{$Advertisments->links()}}
                    </div>
                </section>

                @include('includes.right_bar')
            </div>
        </div>
    </main>
@endsection
