<template>
<!--    <div class="container-fluid">-->

<!--        <div class="ph-item">-->
<!--            <div class="ph-col-4">-->
<!--                <div class="ph-picture"></div>-->
<!--                <div class="ph-row">-->
<!--                    <div class="ph-col-6 big"></div>-->
<!--                    <div class="ph-col-4 empty big"></div>-->
<!--                    <div class="ph-col-2 big"></div>-->
<!--                    <div class="ph-col-4"></div>-->
<!--                    <div class="ph-col-8 empty"></div>-->
<!--                    <div class="ph-col-6"></div>-->
<!--                    <div class="ph-col-6 empty"></div>-->
<!--                    <div class="ph-col-12"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="ph-col-8">-->
<!--                <div class="ph-picture" style="height:40vh;"></div>-->
<!--                <div class="ph-row">-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="ph-col-12 mt-3">-->
<!--                <div class="ph-row">-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                    <div class="ph-col-12 big"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="row hide">-->
<!--            <div class="col-lg-4">-->
<!--                <ul class="list-group mt-4">-->
<!--                    <li class="list-group-item">-->
<!--                        <h4>{{ this.newCasesByPublishDate }}</h4>-->
<!--                        <small>New Cases</small>-->
<!--                    </li>-->
<!--                    <li class="list-group-item">-->
<!--                        <h4>{{ this.newDeathsByDeathDate }}</h4>-->
<!--                        <small>New Deaths</small>-->
<!--                    </li>-->
<!--                    <li class="list-group-item">-->
<!--                        <h4>{{ this.cumCasesByPublishDate }}</h4>-->
<!--                        <small>Accumulative Cases</small>-->
<!--                    </li>-->
<!--                    <li class="list-group-item">-->
<!--                        <h4>{{ this.cumDeathsByDeathDate }}</h4>-->
<!--                        <small>Accumulative Deaths</small>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div class="col-lg-8 col-md-12 col-sm-12">-->
<!--                <canvas id="bar-chart" class="hide" style="height:50vh;"></canvas>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div class="col-lg-12 mb-5">-->
<!--            <ul class="list-group mt-4">-->
<!--                <li class="list-group-item" v-for="stat in stats">-->
<!--                    <h4>{{ stat.newCasesByPublishDate }}</h4>-->
<!--                    <small>New Cases for {{ stat.date }}</small>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->

<!--&lt;!&ndash;        <button class="btn btn-secondary hide" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-laugh-wink"></i> </button>&ndash;&gt;-->

<!--    </div>-->
    <article class="cf">
        <div class="fl w-50 tc stat-card">
            <div class="card-box tilebox-one">
            <span class="icon">
              <img src="assets/img/cases.svg">
            </span>
                <h6 class="black-40 ttu tl">Total Cases</h6>
                <h3 class="black tl" data-plugin="counterup"><span v-if="!cumCasesByPublishDate"><i class="fa fa-spinner fa-pulse"></i></span>{{ cumCasesByPublishDate }}</h3>
            </div>
        </div>
        <div class="fl w-50 tc stat-card">
            <div class="card-box tilebox-one">
            <span class="icon">
              <img src="assets/img/deaths.svg">
            </span>
                <h6 class="black-40 ttu tl">Total Deaths</h6>
                <h3 class="black tl" data-plugin="counterup"><span v-if="!cumDeathsByDeathDate"><i class="fa fa-spinner fa-pulse"></i></span>{{ cumDeathsByDeathDate }}</h3>
            </div>
        </div>
        <div class="fl w-100 tc stat-card">
            <div class="card-box tilebox-one">
            <span class="icon">
              <img src="assets/img/active_cases.svg">
            </span>
                <h6 class="black-40 ttu tl">New Cases For {{ latestDate }}</h6>
                <h3 class="black tl" data-plugin="counterup"><span v-if="!newCasesByPublishDate"><i class="fa fa-spinner fa-pulse"></i></span>{{ newCasesByPublishDate }}</h3>
                <div class="sub-info pt3 pb4" v-if="percentChange.length">
                    <span v-bind:class="'badge mr-1 badge-' + percentType ">{{ percentChange }}</span>
                    <span class="text-muted black-40">from yesterday</span>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
export default {
    name: "Timeline",
    data() {
        return {
            cumCasesByPublishDate: '',
            cumDeathsByDeathDate: '',
            newCasesByPublishDate: '',
            newDeathsByDeathDate: '',
            latestDate: '',
            percentChange: '',
            percentType: '',
            stats: {}
        }
    },
    mounted() {

        console.log(this.percentDiff(41, 52));

        $(".theme-switch").on("click", () => {
            $("body").toggleClass("light-theme");
        });

        const app = this;

        // Optionally the request above could also be done as
        axios.get('/api/stats')
            .then(function (response) {

                app.response = response.data
                app.newCasesByPublishDate = response.data['stats'][0].newCasesByPublishDate;
                app.newDeathsByDeathDate = response.data['stats'][0].newDeathsByDeathDate;
                app.latestDate = response.data['stats'][0].date;
                app.cumCasesByPublishDate = response.data.cumCasesByPublishDate;
                app.cumDeathsByDeathDate = response.data.cumDeathsByDeathDate;
                app.stats = response.data['stats'];
                app.percentChange = app.percentDiff(response.data['stats'][0].newCasesByPublishDate, response.data['stats'][1].newCasesByPublishDate)
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });

    },
    methods: {
        percentDiff: function (a, b){
            var decreaseValue = a - b;

            let value = Math.round((decreaseValue / b) * 100);

            if (value < 0) {
                 this.percentType = 'success';
                return Math.abs(value) + "% Decrease";
            }

            this.percentType = 'danger';
            return value + "% Increase";
        }
    },
}
</script>

<style scoped>
.hide{
    display: none;
}
</style>
