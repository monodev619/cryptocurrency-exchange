import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'

export const state = {
    orders: null,
    open_orders: null,
}

export const getters = {
    orders: state => state.orders,
    open_orders: state => state.open_orders,
}



export const mutations = {

    [types.GET_ORDERS] (state, {res}) {
        state.orders = res;

    },
    [types.GET_OPENORDERS] (state, {res}) {
        state.open_orders = res;

    }
}

export const actions = {
    getOrders ({ commit, dispatch }, payload) {
        commit(types.GET_ORDERS, payload);
    },
    getOpenOrders ({ commit, dispatch }, payload) {
        commit(types.GET_OPENORDERS, payload);
    }
}