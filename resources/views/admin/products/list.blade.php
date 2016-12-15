@extends('layouts.app')

@section('content')
<script>
 app.config(function($routeProvider){
    $routeProvider
        .when("/page/:pageid", {
            controller: "products",
            templateUrl: "/products-listing.html"
        })
        .otherwise({
            redirectTo: "/page/1"
        });

    // $locationProvider.html5Mode(true);
});
</script>


<ng-view></ng-view>

<script type="text/ng-template" id="/products-listing.html">
     <div class="container">

        <div class="filters col-lg-4">
            <form action="#">
                <div class="form-group">
                    <label for="group">Grupo:</label>
                    <select name="group" id="group" ng-model="filters.group_id" class="form-control" ng-change="filtrarGrupo()">
                        <option value="0">Todos</option>
                        <option ng-repeat="group in groups" value="@{{group.id}}">@{{group.group_name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="group">Ordenar por:</label>
                    <select name="group" id="group" class="form-control">
                        <option value="0">Sin ordenar</option>
                        <option value="price">Precio</option>
                        <option value="stockhmo">Disponible para recoger HMO</option>
                    </select>
                </div>
            </form>
        </div>


        <table class="table">
            <tr>        
                <td>Modelo</td>
                <td style="width:50%">Producto</td>
                <td>Precio</td>
                <td>Stock HMO</td>
                <td>Grupo</td>
            </tr>
            <tr ng-repeat="product in products">
                <td>@{{product.model}}</td>
                <td>@{{product.name}}</td>
                <td>@{{product.price}}</td>
                <td>@{{product.quantity}}</td>
                <td>@{{product.group_name}}</td>
            </tr>
        </table>

        <div class="container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li ng-repeat="page in pages">
                        <a href="{{url("admin/products")}}/#!/page/@{{page}}">@{{page}}</a>
                    </li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</script>

<script>
    app.controller("products", function($scope, $routeParams, $http) {
        $scope.products = [];
        $scope.groups   = [];
        $scope.filters  = [];
        $scope.page     = $routeParams.pageid;
        $scope.pages    = [];
        $scope.perpage  = 20;
        $scope.filters.group_id = 0;


        function get_all_data() {

            $http({
                url     : server + "api/auth",
                method  : "POST",
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
                data    : $.param({
                    email: "iecs_1990@hotmail.com",
                    password: "123456"
                })
            }).then(function(res){
                


                $http({
                    url: server + "api/groups",
                    method: "GET",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'authorization' : "Bearer " + res.token
                    }
                }).then(function(res){
                    if(res.status == 200) {
                        $scope.groups = res.data.groups_suppliers;
                    }
                });
                
                
                
                $http({
                    url: server + "api/products",
                    method: "GET",
                    params: { 
                        size   : $scope.perpage, 
                        offset : $scope.perpage * ($scope.page - 1),
                        filters: $scope.filters
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'authorization' : "Bearer " + res.token
                    }
                }).then(function(res){
                    if(res.status == 200) {
                        $scope.products = res.data.items;
                        $scope.total    = res.data.total;

                        for(var i = $scope.page; i <= (parseInt($scope.page) + 5); i++) 
                            $scope.pages.push(i);
                    }
                });

            });
        }

        get_all_data();

        $scope.filtrarGrupo = function() {
            $scope.filters.group_id = $scope.group;
            get_all_data();
        };
    })
</script>
@endsection 