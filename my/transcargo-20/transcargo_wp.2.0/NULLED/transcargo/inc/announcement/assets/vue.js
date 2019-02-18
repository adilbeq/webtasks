window.addEventListener('load', function () {

    var announcements = 'https://stylemixthemes.scdn2.secure.raxcdn.com/api/announcement.json';

    new Vue({
        el: '#pearl-announcement',
        data: {
            announcements:[]
        },
        mounted: function () {
            this.$http.get(announcements).then(function (response) {
                this.announcements = response.data;
                var title = this.announcements.announcement.title;
                jQuery('#pearl_dashboard_announcement h2 > span').text(title);
            }, function(){
                /*Error given*/
                jQuery('#pearl_dashboard_announcement').slideUp();
            });
        }
    })
});