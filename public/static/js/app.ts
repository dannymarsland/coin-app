///<reference path="../def/jquery/jquery.d.ts"/>

// basic definition for featherlight lightbox
interface featherlight {
    (content: any, config? : any) : JQueryStatic
}

interface JQueryStatic {
    featherlight : featherlight;
}

class Application {

    private resultsSelector = '#results';
    private lightBox: LightBox;
    private form: ValueForm;

    constructor() {
        $(document).ready(()=>this.ready());
    }

    private ready() {
        this.lightBox = new LightBox();
        // enhance the form to submit via ajax, and then show the results in a light box
        this.form = new ValueForm($('#value-form'),
            ()=>this.showLoading(),
            (data) => {
                this.hideLoading();
                var $results = this.parseResults(data);
                this.lightBox.show($results);
            }, () => {
                this.hideLoading();
                this.showError('An network error has occurred, please try again')
            }
        );

        // if we have gone directly to a page with results on it then show the results in the lightbox
        var $results = $(this.resultsSelector);
        if ($results.length) {
            // remove from dom as featherlight appears to copy the content and not move it
            // on a timeout as featherlight doesnt animate well without
            setTimeout(()=>{
                this.lightBox.show($results)
            },200);
        }

    }

    private parseResults(html: string) : JQuery {
        return $(html).find(this.resultsSelector).first();
    }

    private showLoading() {
        console.log('show loading....');
    }

    private hideLoading() {
        console.log('hide loading....');
    }

    private showError(msg: string) {
        alert(msg);
    }
}

class ValueForm {
    constructor($form: JQuery, private onSubmit: ()=>void, private onSuccess: (data)=>void, private onError: ()=>void) {
        $form.submit((ev) =>{
            this.onSubmit();
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                success: (data) => {
                    this.onSuccess(data);
                },
                error: (data) => {
                    console.error('Error submitting form');
                    this.onError();
                }
            });
            ev.preventDefault();
        });
    }
}

class LightBox {

    public show($content : JQuery) {
        $.featherlight($content);
    }

}

// start everything off
var app = new Application();
