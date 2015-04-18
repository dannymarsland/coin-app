///<reference path="../def/jquery/jquery.d.ts"/>

// basic definition for featherlight lightBox
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
        // call the class ready function on ready
        $(document).ready(()=>this.ready());
    }

    private ready() {
        //create lightBox and form objects, keep local copy in case we need to interact with them later

        this.lightBox = new LightBox();
        // enhance the form to submit via ajax, and then show the results in a light box
        this.form = new ValueForm($('#value-form'),
            // show loading on submit
            ()=>this.showLoading(),
            (data) => {
                // hide loading and process the returned data
                this.hideLoading();
                var $results = this.parseResults(data);
                // show the results
                this.lightBox.show($results);
            }, () => {
                // hide loading and inform user of an error
                this.hideLoading();
                this.showError('An network error has occurred, please try again')
            }
        );

        // if we have gone directly to a page with results on it then show the results in the lightBox
        var $results = $(this.resultsSelector);
        if ($results.length) {
            // remove from dom as featherlight appears to copy the content and not move it
            // on a timeout as featherlight doesn't animate well without
            setTimeout(()=>{
                this.lightBox.show($results)
            },200);
        }

    }

    private parseResults(html: string) : JQuery {
        // extract the results from the html string
        return $(html).find(this.resultsSelector).first();
    }

    private showLoading() {
        // @todo
        console.log('show loading....');
    }

    private hideLoading() {
        // @todo
        console.log('hide loading....');
    }

    private showError(msg: string) {
        alert(msg);
    }
}

class ValueForm {
    constructor($form: JQuery, private onSubmit: ()=>void, private onSuccess: (data)=>void, private onError: ()=>void) {
        // submit via ajax
        $form.submit((ev) =>{
            // call the onSubmit callback
            this.onSubmit();
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                success: (data) => {
                    // call the onSuccess callback
                    this.onSuccess(data);
                },
                error: (data) => {
                    console.error('Error submitting form');
                    // call the onError callback
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
