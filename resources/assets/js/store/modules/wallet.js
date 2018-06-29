import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'


export const state = {
    currencies: null,
    depositHistory: null,
    withdrawHistory: null,
    pendingDeposits: null,
    pendingWithdraws: null,
    balanceCurrencies: null,
}

export const getters = {
    currencies: state => state.currencies,
    depositHistorys: state => state.depositHistory,
    withdrawHistorys: state => state.withdrawHistory,
    pendingDeposits: state => state.pendingDeposits,
    pendingWithdraws: state => state.pendingWithdraws,
    balanceCurrencies: state => state.balanceCurrencies,


}

export const mutations = {

    [types.GET_CURRENCIES] (state, {res}) {
        state.currencies = res
    },

    [types.GET_DEPOSITHISTORY] (state, {res}) {
        state.depositHistory = res
    },

    [types.GET_WITHDRAWHISTORY] (state, {res}) {
        state.withdrawHistory = res
    },

    [types.GET_PENDINGDEPOSITS] (state, {res}) {
        state.pendingDeposits = res
    },

    [types.GET_PENDINGWITHDRAWS] (state, {res}) {
        state.pendingWithdraws = res
    },

    [types.GET_BALANCES] (state, {res}) {
        state.balanceCurrencies = res;
    },
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

    getPendingDeposits ({ commit }, payload) {
        commit(types.GET_PENDINGDEPOSITS, payload)
    },

    getPendingWithdraws ({ commit }, payload) {
        commit(types.GET_PENDINGWITHDRAWS, payload)
    },

    getBalances ({ commit, dispatch }, payload) {
        commit(types.GET_BALANCES, payload)
    }


}

