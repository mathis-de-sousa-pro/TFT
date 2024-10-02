<?php

namespace Views;

class constructor
{
    public static function createAllCards($units): string
    {
        $html = '<div class="row row-cols-1 row-cols-xl-3 row-cols-xxl-5 row-cols-md-2 g-5 m-5">';
        foreach ( $units as $unit )
        {
            $html .= self::createCard($unit);
        }
        $html .= '</div>';
        return $html;
    }


    public static function createCard($unit): string
    {
        $imageUrl = htmlspecialchars($unit['url_image']);
        return '
        <div class="col">
            <div class="card h-100 text-white shadow">
                <img class="card-img" src="' . $imageUrl . '" alt="Card image">
                <div class="card-img-overlay">
                    <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                        <div id="carouselExample' . htmlspecialchars($unit['id']) . '" class="carousel slide flex-fill">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <h1>' . htmlspecialchars($unit['name']) . '</h1>
                                </div>
                                <div class="carousel-item">
                                    <h1>' . htmlspecialchars($unit['cost']) . '</h1>
                                </div>
                                <div class="carousel-item">
                                    <h1>' . htmlspecialchars($unit['origin']) . '</h1>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample'
               . htmlspecialchars($unit['id']) . '" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample'
               . htmlspecialchars($unit['id']) . '" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    public static function createNavbar()
    {
        return '
        <nav class="m-3 mx-5 py-4 navbar rounded shadow navbar-expand-lg navbar-light bg-body-secondary fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="https://cdn-icons-png.flaticon.com/512/3208/3208681.png " alt="logo"
                     width="50" height="50" class="d-inline-block align-top">
            </a>
            <a class="navbar-brand" href="../index.php?action=add-unit-origin">
                <img src="https://cdn-icons-png.flaticon.com/512/738/738882.png" alt="logo" width="50" height="50"
                     class="d-inline-block align-top">
            </a>
            
            <a class="navbar-brand" href="../index.php?action=search">
                <img src="https://cdn-icons-png.flaticon.com/512/751/751381.png " alt="logo" width="50" height="50"
                     class="d-inline-block align-top">
            </a>
        </div>
    </nav>
    ';
    }

    public static function createForm()
    {
        return '   
    <div class="container m-5 py-5">
        <div class="form">
            <div class="row">
                <input type="text" class="form-control" placeholder="name" aria-label="name">
            </div>
            <div class="row">
                <input type="text" class="form-control" placeholder="url image" aria-label="url image">
            </div>
            <div class="row">
                <label for="customRange3" class="form-label">cost</label>
                <input type="range" class="form-range" min="1" max="5" step="1" id="customRange3">
            </div>

        </div>
    </div>';
    }
}