import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'


export const state = {
    currencies: null,
    depositHistory: null,
    withdrawHistory: null
}

export const getters = {
    currencies: state => state.currencies,
    depositHistorys: state => state.depositHistory,
    withdrawHistorys: state => state.withdrawHistory


}

export const mutations = {

    [types.GET_CURRENCIES] (state, {currencies}) {
        state.currencies = currencies
    },

    [types.GET_DEPOSITHISTORY] (state, {currencies}) {
        state.depositHistory = currencies
    },

    [types.GET_WITHDRAWHISTORY] (state, {currencies}) {
        state.withdrawHistory = currencies
    }
}

export const actions = {

    getCurrencies ({ commit }, payload) {
        commit(types.GET_CURRENCIES, payload)
    },

    getdepositHistory ({ commit }, payload) {
        commit(types.GET_DEPOSITHISTORY, payload)
    },

    getwithdrawHistory ({ commit }, payload) {
        commit(types.GET_WITHDRAWHISTORY, payload)
    },


}

