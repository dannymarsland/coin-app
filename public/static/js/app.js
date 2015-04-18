///<reference path="../def/jquery/jquery.d.ts"/>
var Application = (function () {
    function Application() {
        var _this = this;
        this.resultsSelector = '#results';
        $(document).ready(function () { return _this.ready(); });
    }
    Application.prototype.ready = function () {
        var _this = this;
        this.lightBox = new LightBox();
        // enhance the form to submit via ajax, and then show the results in a light box
        this.form = new ValueForm($('#value-form'), function () { return _this.showLoading(); }, function (data) {
            _this.hideLoading();
            var $results = _this.parseResults(data);
            _this.lightBox.show($results);
        }, function () {
            _this.hideLoading();
            _this.showError('An network error has occurred, please try again');
        });
        // if we have gone directly to a page with results on it then show the results in the lightbox
        var $results = $(this.resultsSelector);
        if ($results.length) {
            // remove from dom as featherlight appears to copy the content and not move it
            // on a timeout as featherlight doesnt animate well without
            setTimeout(function () {
                _this.lightBox.show($results);
            }, 200);
        }
    };
    Application.prototype.parseResults = function (html) {
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
        $form.submit(function (ev) {
            _this.onSubmit();
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function (data) {
                    _this.onSuccess(data);
                },
                error: function (data) {
                    console.error('Error submitting form');
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