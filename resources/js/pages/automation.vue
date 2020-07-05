<template>
    <div class="col-12">
        <div class="d-flex align-items-center pb-3 pb-md-5">
            <div class="mr-auto">
                <h4 class="d-inline-block m-0">Автоматизация</h4>
            </div>
            <router-link tag="button" :to="{ name: 'automation-edit', params: { id: 'new' }}"
                         class="btn float-right">
                Добавить новую
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
                        <span>{{$t(item.source)}}</span>
                    </div>
                    <div class="info">
                        <span>{{item.workflow === 0 ? $t('export'): $t('POST URL') }}</span>
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
                    <li class="page-item" :class="{disabled : this.prev_page_url === null}">
                        <a class="page-link" href="javascript:void(0);"
                           @click="fetchAutomation(prev_page_url)">&laquo;</a>
                    </li>
                    <li v-for="n in Math.ceil(this.total / this.per_page)" class="page-item"
                        :class="{active : current_page === n}">
                        <a class="page-link" @click="fetchAutomation(path + '?page=' + n)" href="javascript:void(0);">{{n}}</a>
                    </li>
                    <li class="page-item" :class="{disabled : this.next_page_url === null}">
                        <a class="page-link" href="javascript:void(0);"
                           @click="fetchAutomation(next_page_url)">&raquo</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div v-else class="card">
            <div class="card-body text-center">
                <h4>Empty automation</h4>
                <p class="pb-5">Автоматизируйте работу Вашего магазина</p>
                <router-link tag="button" :to="{ name: 'automation-edit', params: { id: 'new' }}"
                             class="btn btn-add">
                    Добавить новую
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
            automation: [],
            current_page: 1,
            first_page_url: null,
            last_page: 1,
            next_page_url: null,
            path: null,
            per_page: null,
            prev_page_url: null,
            total: 0,
        }),

        metaInfo() {
            return {title: this.$t('automation')}
        },

        created() {
            this.fetchAutomation();
        },
        methods: {
            fetchAutomation(url = null) {
                axios.get(url ?? 'api/automation').then(response => {
                    this.automation = response.data.data;
                    this.current_page = response.data.current_page;
                    this.first_page_url = response.data.first_page_url;
                    this.last_page = response.data.last_page;
                    this.next_page_url = response.data.next_page_url;
                    this.path = response.data.path;
                    this.per_page = response.data.per_page;
                    this.prev_page_url = response.data.prev_page_url;
                    this.total = response.data.total;
                }).catch(function (e) {
                    console.log(e.response);
                });


            },
        }
    }
</script>
