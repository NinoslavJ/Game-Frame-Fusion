@extends('auth.layouts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar / Categories -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <ul class="list-group">
                        <!-- Categories list -->
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('dashboard', ['category' => $category->category]) }}">
                                    {{ $category->category }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <br>
            
            <!-- Slider for randomItems1 -->
            <div class="card mb-4">
                <h3>Slider 1</h3>
                <div id="carouselRandomItems1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">                    
                             <!-- Static content for Slider 1 -->
                                <div class="carousel-item active">
                                <img src="{{ asset('SlidersImages/ps3.jpg') }}" class="d-block w-100" alt="Example Image">
                                    <div class="carousel-caption">
                                        <h5>Item 1</h5>
                                        <p>Price: $10</p>
                                        <!-- Add more item details if needed -->
                                    </div>
                                </div>
                                <div class="carousel-item active">
                                <img src="{{ asset('SlidersImages/ps4.jpg') }}" class="d-block w-100" alt="Example Image">
                                    <div class="carousel-caption">
                                        <br>
                                        <h5>Item 2</h5>
                                        <p>Price: $10</p>
                                        <!-- Add more item details if needed -->
                                    </div>
                                </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRandomItems1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRandomItems1" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Slider for randomItems2 -->
            <div class="card mb-4">
                <h3>Slider 2</h3>
                <div id="carouselRandomItems2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($randomItems2 as $index => $item)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $item->picture }}" class="d-block w-100" alt="{{ $item->name }}">
                                <div class="carousel-caption">
                                    <h5>{{ $item->name }}</h5>
                                    <p>Price: ${{ $item->price }}</p>
                                    <!-- Add more item details if needed -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRandomItems2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRandomItems2" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>


        <!-- Main Content / Items Section -->
        <div class="col-md-9">
            <!-- Sorting links -->
            <div class="mb-3">
                <strong>Sort by:</strong>
                <a href="{{ route('dashboard', ['category' => $selectedCategory, 'sortBy' => 'price', 'sortDirection' => 'asc']) }}">Price Low to High</a> |
                <a href="{{ route('dashboard', ['category' => $selectedCategory, 'sortBy' => 'price', 'sortDirection' => 'desc']) }}">Price High to Low</a>
            </div>
            <div class="row">
                <!-- Loop through items and display each item in a card format -->
                @foreach ($items as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <!-- Item image -->
                            <img src="{{ $item->picture }}" class="card-img-top" alt="{{ $item->name }}">

                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Item price -->
                                <h5 class="card-title">Price: ${{ $item->price }}</h5>
                                
                                <!-- Item category -->
                                <p class="card-text">Category: {{ $item->category }}</p>
                                
                                <!-- Button to add item to cart -->
                                <form action="{{ route('addToCart', ['id' => $item->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Bootstrap Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $items->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $items->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $items->lastPage(); $i++)
                        <li class="page-item {{ $i == $items->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $items->currentPage() == $items->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $items->nextPageUrl() ?? '#' }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
