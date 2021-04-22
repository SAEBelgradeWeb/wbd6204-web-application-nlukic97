/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//personal profile components
Vue.component('profile-picture', require('./components/personalProfile/ProfilePicture.vue').default);
Vue.component('profile-bio', require('./components/personalProfile/ProfileBio').default);
Vue.component('profile-content', require('./components/personalProfile/ProfileContent').default);
Vue.component('upload-image', require('./components/personalProfile/UploadImage').default);

//other profile components
Vue.component('other-profile-bio', require('./components/otherProfile/OtherProfileBio').default);
Vue.component('other-profile-content', require('./components/otherProfile/OtherProfileContent').default);
    //other user profile pictures
Vue.component('other-profile-picture', require('./components/otherProfile/OtherProfilePicture').default);
Vue.component('non-friend-profile-picture', require('./components/otherProfile/nonFriendProfilePicture').default);

// account-settings components
Vue.component('setting-element', require('./components/userSettings/settingElement').default);
Vue.component('change-password', require('./components/userSettings/changePassword').default);

// event components
Vue.component('locations-and-courts', require('./components/eventCreation/LocationsAndCourts').default);

//Event index components
Vue.component('event-info', require('./components/eventDisplay/eventInfo').default);
Vue.component('event-messages', require('./components/eventDisplay/eventMessages').default);

//Search components
Vue.component('user-search', require('./components/search/userSearch').default);
Vue.component('event-search', require('./components/search/eventSearch').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
