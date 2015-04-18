///<reference path="../def/jquery/jquery.d.ts"/>
var Application = (function () {
    function Application() {
        var _this = this;
        this.resultsSelector = '#results';
        // call the class ready function on ready
        $(document).ready(function () { return _this.ready(); });
    }
    Application.prototype.ready = function () {
        //create lightBox and form objects, keep local copy in case we need to interact with them later
        var _this = this;
        this.lightBox = new LightBox();
        // enhance the form to submit via ajax, and then show the results in a light box
        this.form = new ValueForm($('#value-form'), 
        // show loading on submit
        function () { return _this.showLoading(); }, function (data) {
            // hide loading and process the returned data
            _this.hideLoading();
            var $results = _this.parseResults(data);
            // show the results
            _this.lightBox.show($results);
        }, function () {
            // hide loading and inform user of an error
            _this.hideLoading();
            _this.showError('An network error has occurred, please try again');
        });
        // if we have gone directly to a page with results on it then show the results in the lightBox
        var $results = $(this.resultsSelector);
        if ($results.length) {
            // remove from dom as featherlight appears to copy the content and not move it
            // on a timeout as featherlight doesn't animate well without
            setTimeout(function () {
                _this.lightBox.show($results);
            }, 200);
        }
    };
    Application.prototype.parseResults = function (html) {
        // extract the results from the html string
        return $(html).find(this.resultsSelector).first();
    };
    Application.prototype.showLoading = function () {
        // @todo
        console.log('show loading....');
    };
    Application.prototype.hideLoading = function () {
        // @todo
        console.log('hide loading....');
    };
    Application.prototype.showError = function (msg) {
        alert(msg);
    };
    return Application;
})();
var ValueForm = (function () {
    function ValueForm($form, onSubmit, onSuccess, onError) {
        var _this = this;
        this.onSubmit = onSubmit;
        this.onSuccess = onSuccess;
        this.onError = onError;
        // submit via ajax
        $form.submit(function (ev) {
            // call the onSubmit callback
            _this.onSubmit();
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function (data) {
                    // call the onSuccess callback
                    _this.onSuccess(data);
                },
                error: function (data) {
                    console.error('Error submitting form');
                    // call the onError callback
                    _this.onError();
                }
            });
            ev.preventDefault();
        });
    }
    return ValueForm;
})();
var LightBox = (function () {
    function LightBox() {
    }
    LightBox.prototype.show = function ($content) {
        $.featherlight($content);
    };
    return LightBox;
})();
// start everything off
var app = new Application();
//# sourceMappingURL=app.js.map