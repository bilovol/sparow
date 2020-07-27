<template>
    <div class="col-md-10">
        <div class="d-flex align-items-center pb-3 pb-md-5">
            <div class="mr-auto">
                <h4 class="d-inline-block m-0">
                    {{ $t('Automation') }}
                </h4>
            </div>
            <router-link v-if="automation.length > 0" tag="button"
                         :to="{ name: 'automation-edit', params: { id: 'new' }}"
                         class="btn float-right">
                {{ $t('Add new') }}
            </router-link>
        </div>
        <div v-if="automation.length > 0">
            <switch-automation-grid></switch-automation-grid>
            <ul id="automation" class="list">
                <li v-for="item in automation">
                    <div class="name">
                        <router-link :to="{ name: 'automation-edit', params: { id: item.id }}">
                            {{item.name}}
                        </router-link>
                    </div>
                    <div class="info">
                        <span>{{$t(item.event)}}</span>
                    </div>
                    <div class="info">
                        <span>{{$t(item.workflow)}}</span>
                    </div>
                    <div class="info">
                        <span>{{ item.status === 1 ? $t('active') : $t('disable') }}</span>
                    </div>
                    <router-link tag="button" :to="{ name: 'automation-edit', params: { id: item.id }}"
                                 class="btn btn-edit">
                        <eva-icon name="edit-outline"></eva-icon>
                    </router-link>

                </li>
            </ul>
            <nav v-if="this.total > this.per_page">
                <ul class="pagination">
                    <li class="page-item" :class="{disabled : this.current_page === 1}">
                        <a class="page-link" href="javascript:void(0);"
                           @click="fetchAutomation(current_page - 1)">&laquo;</a>
                    </li>
                    <li v-for="page in this.pages" class="page-item"
                        :class="{active : current_page === page}">
                        <a class="page-link" @click="fetchAutomation(page)" href="javascript:void(0);">{{page}}</a>
                    </li>
                    <li class="page-item" :class="{disabled : current_page === pages}">
                        <a class="page-link" href="javascript:void(0);"
                           @click="fetchAutomation(current_page + 1)">&raquo</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div v-else class="card">
            <div class="card-body text-center">
                <h4>{{$t("We couldn't find any data")}}</h4>
                <p class="pb-5">{{$t('Automate routine work')}}</p>
                <router-link tag="button" :to="{ name: 'automation-edit', params: { id: 'new' }}"
                             class="btn btn-add">
                    {{ $t('Create new One') }}
                </router-link>
            </div>
        </div>


    </div>
</template>

<script>
    import {EvaIcon} from 'vue-eva-icons'
    import SwitchAutomationGrid from "../components/SwitchAutomationGrid";
    import axios from "axios";

    export default {
        components: {
            SwitchAutomationGrid,
            [EvaIcon.name]: EvaIcon
        },

        middleware: 'auth',

        data: () => ({
            apiUrl: window.config.apiUrl,
            automation: [],
            total: 0,
            per_page: 1,
            current_page: 1,
            pages: 0,
        }),

        metaInfo() {
            return {title: this.$t('Automation')}
        },

        created() {
            this.fetchAutomation();
        },
        methods: {
            fetchAutomation(page = null) {
                axios.get(page ? this.apiUrl + '/automation?page=' + page : this.apiUrl + '/automation').then(response => {
                    this.automation = response.data.data;
                    this.total = response.data.pagination.total;
                    this.per_page = response.data.pagination.per_page;
                    this.current_page = response.data.pagination.current_page;
                    this.pages = Math.ceil(response.data.pagination.total / response.data.pagination.per_page);
                }).catch(function (e) {
                    console.log(e.response);
                });
            },
        }
    }
</script>
