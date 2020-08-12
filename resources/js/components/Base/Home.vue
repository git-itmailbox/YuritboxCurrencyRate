<template>
    <el-row class="container">
        <el-col :span="24" class="header">
            <el-col :span="10" class="logo" :class="collapsed?'logo-collapse-width':'logo-width'">
                {{collapsed?'':sysName}}
            </el-col>
            <el-col :span="10">
                <div class="tools" @click.prevent="collapse">
                    <i class="fa fa-align-justify"></i>
                </div>
            </el-col>
            <el-col :span="4" class="userinfo">
                <el-dropdown trigger="hover">
                    <span class="el-dropdown-link userinfo-inner"><img
                        src="/avatar.jpg"/> USERNAME: {{sysUserName}}</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item divided @click.native="logout">Logout</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-col>
        </el-col>
        <el-col :span="24" class="main">
            <aside>
                <el-menu :default-active="$route.path" class="el-menu-vertical-demo" @open="handleopen"
                         @close="handleclose"
                         @select="handleselect"
                         router
                         :collapse="collapsed">
                    <template v-for="(item,index) in $router.options.routes[0].children" v-if="menuItemIsAvailable(item)">
                        <el-submenu :index="index+''" v-if="!item.meta.leaf">
                            <template slot="title">
                                <i :class="item.meta.uiIcon"></i>
                                <span slot="title">{{ item.name }}</span>
                            </template>
                            <el-menu-item :route="child" v-for="child in item.children"
                                          :index="child.path"
                                          :key="child.path"
                                          v-if="menuItemIsAvailable(child)">
                                <span slot="title">{{ child.name }}</span>
                            </el-menu-item>
                        </el-submenu>
                        <el-menu-item :route="item" v-if="item.meta.leaf" :index="item.path">
                            <i :class="item.meta.uiIcon"></i>
                            <span slot="title">{{ item.name }}</span>
                        </el-menu-item>
                    </template>
                </el-menu>
            </aside>
            <section class="content-container">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="breadcrumb-container">
                        <strong class="title">{{ $route.name }}</strong>
                        <el-breadcrumb separator="/" class="breadcrumb-inner">
                            <el-breadcrumb-item v-for="item in $route.matched" :key="item.path">
                                {{ item.name }}
                            </el-breadcrumb-item>
                        </el-breadcrumb>
                    </el-col>
                    <el-col :span="24" class="content-wrapper">
                        {{sysUserName}}
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data() {
            return {
                sysName: 'Currency rates',
                collapsed: false,
                sysUserName: '',
                sysUserAvatar: '',
                form: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                }
            }
        },
        methods: {
            menuItemIsAvailable(item) {
                let allowed = !item.meta.hidden;
                if (allowed && item.meta && item.meta.auth) {
                    allowed = this.$auth.check(item.meta.auth);
                }
                return allowed;
            },
            onSubmit() {
                console.log('submit!')
            },
            handleopen() {
                //console.log('handleopen');
            },
            handleclose() {
                //console.log('handleclose');
            },
            handleselect: function (a, b) {
            },
            logout: function () {
                this.$confirm("Are you sure", 'Logout', {
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Cancel',
                }).then(() => {
                    this.$auth.logout()
                }).catch(() => {

                })


            },
            //折叠导航栏
            collapse: function () {
                this.collapsed = !this.collapsed
            },
            showMenu(i, status) {
                // this.$refs.menuCollapsed.getElementsByClassName('submenu-hook-' + i)[0].style.display = status ? 'block' : 'none'
            }
        },
        mounted() {
            const user = this.$auth.user()
            console.log(this.$router.options.routes[0].children)
            if (user) {
                // user = JSON.parse(user)
                this.sysUserName = user.name || ''
                this.sysUserAvatar = user.avatar || ''
                console.log(user.name)
                console.log(this.sysUserName)

            }

            if (window.innerWidth < 768) {
                this.collapsed = true
            }
        }
    }

</script>

<style scoped lang="scss">
    /*@import '~scss_vars';*/

    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 230px;
        min-height: 400px;
    }

    .container {
        position: absolute;
        top: 0px;
        bottom: 0px;
        width: 100%;

        .header {
            height: 60px;
            line-height: 60px;
            background: #20a0ff;
            color: #fff;

            .userinfo {
                text-align: right;
                padding-right: 35px;
                float: right;

                .userinfo-inner {
                    cursor: pointer;
                    color: #fff;

                    img {
                        width: 40px;
                        height: 40px;
                        border-radius: 20px;
                        margin: 10px 0px 10px 10px;
                        float: right;
                    }
                }
            }

            .logo {
                //width:230px;
                height: 60px;
                font-size: 22px;
                padding-left: 20px;
                padding-right: 20px;
                border-color: rgba(238, 241, 146, 0.3);
                border-right-width: 1px;
                border-right-style: solid;

                img {
                    width: 40px;
                    float: left;
                    margin: 10px 10px 10px 18px;
                }

                .txt {
                    color: #fff;
                }
            }

            .logo-width {
                width: 230px;
            }

            .logo-collapse-width {
                width: 65px
            }

            .tools {
                padding: 0px 23px;
                width: 14px;
                height: 60px;
                line-height: 60px;
                cursor: pointer;
            }
        }

        .main {
            display: flex;
            position: absolute;
            top: 60px;
            bottom: 0px;
            overflow: hidden;

            aside {
                .el-menu {
                    height: 100%;
                }

                .collapsed {
                    width: 60px;

                    .item {
                        position: relative;
                    }

                    .submenu {
                        position: absolute;
                        top: 0px;
                        left: 60px;
                        z-index: 99999;
                        height: auto;
                        display: none;
                    }

                }
            }

            .menu-collapsed {
                flex: 0 0 60px;
                width: 60px;
            }

            .menu-expanded {
                flex: 0 0 230px;
                width: 230px;
            }

            .content-container {
                flex: 1;
                overflow-y: scroll;
                padding: 10px;

                .breadcrumb-container {
                    .title {
                        width: 400px;
                        float: left;
                        color: #475669;
                    }

                    .breadcrumb-inner {
                        float: right;
                    }
                }

                .content-wrapper {
                    background-color: #fff;
                    box-sizing: border-box;
                }
            }
        }
    }
</style>
