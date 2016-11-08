System.register(['@angular/core', './demo.service', 'rxjs/Rx'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, demo_service_1, Rx_1;
    var AppComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (demo_service_1_1) {
                demo_service_1 = demo_service_1_1;
            },
            function (Rx_1_1) {
                Rx_1 = Rx_1_1;
            }],
        execute: function() {
            AppComponent = (function () {
                function AppComponent(_demoService) {
                    this._demoService = _demoService;
                }
                AppComponent.prototype.ngOnInit = function () {
                    this.getFoods();
                    this.getBooksAndMovies();
                };
                AppComponent.prototype.getFoods = function () {
                    var _this = this;
                    this._demoService.getFoods().subscribe(
                    // the first argument is a function which runs on success
                    function (data) { _this.foods = data; }, 
                    // the second argument is a function which runs on error
                    function (err) { return console.error(err); }, 
                    // the third argument is a function which runs on completion
                    function () { return console.log('done loading foods'); });
                };
                AppComponent.prototype.getBooksAndMovies = function () {
                    var _this = this;
                    this._demoService.getBooksAndMovies().subscribe(function (data) {
                        _this.books = data[0];
                        _this.movies = data[1];
                    });
                };
                AppComponent.prototype.createFood = function (name) {
                    var _this = this;
                    var food = { name: name };
                    this._demoService.createFood(food).subscribe(function (data) {
                        // refresh the list
                        _this.getFoods();
                        return true;
                    }, function (error) {
                        console.error("Error saving food!");
                        return Rx_1.Observable.throw(error);
                    });
                };
                AppComponent.prototype.updateFood = function (food) {
                    var _this = this;
                    this._demoService.updateFood(food).subscribe(function (data) {
                        // refresh the list
                        _this.getFoods();
                        return true;
                    }, function (error) {
                        console.error("Error saving food!");
                        return Rx_1.Observable.throw(error);
                    });
                };
                AppComponent.prototype.deleteFood = function (food) {
                    var _this = this;
                    if (confirm("Are you sure you want to delete " + food.name + "?")) {
                        this._demoService.deleteFood(food).subscribe(function (data) {
                            // refresh the list
                            _this.getFoods();
                            return true;
                        }, function (error) {
                            console.error("Error deleting food!");
                            return Rx_1.Observable.throw(error);
                        });
                    }
                };
                AppComponent = __decorate([
                    core_1.Component({
                        selector: 'demo-app',
                        template: "\n  <h1>Angular2 HTTP Demo App</h1>\n  <h2>Games</h2>\n  <ul>\n    <li *ngFor=\"let food of foods\">\n    Id:{{food.id}}<br>\n    Name:<input type=\"text\" name=\"food-name\" [(ngModel)]=\"food.name\"><br>\n    Desc:  <input type=\"text\" name=\"food-name\" [(ngModel)]=\"food.description\"><br>\n    Year:<input type=\"text\" name=\"food-name\" [(ngModel)]=\"food.releaseYear\"><br>\n    Genre:<input type=\"text\" name=\"food-name\" [(ngModel)]=\"food.genre\"><br>\n        Char:<input type=\"text\" name=\"food-name\" [(ngModel)]=\"food.characters\"><br>\n    <button (click)=\"updateFood(food)\">Save</button> <button (click)=\"deleteFood(food)\">Delete</button></li>\n  </ul>\n  <p>Add a new game: <input type=\"text\" name=\"food_name\" [(ngModel)]=\"food_name\"><button (click)=\"createFood(food_name)\">Save</button></p>\n  <h2>Games</h2>\n  <h3>Games</h3>\n  <ul>\n    <li *ngFor=\"let food of foods\">{{food.name}}</li>\n  </ul>\n  <!--<h3>Movies</h3>\n  <ul>\n    <li *ngFor=\"let movie of movies\">{{movie.title}}</li>\n  </ul>-->\n  "
                    }), 
                    __metadata('design:paramtypes', [demo_service_1.DemoService])
                ], AppComponent);
                return AppComponent;
            }());
            exports_1("AppComponent", AppComponent);
        }
    }
});
//# sourceMappingURL=app.component.js.map