import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'

export const state = {
    btc_markets: null,
    eth_markets: null,
    left_markets: null,
    // markets: null,
}

export const getters = {
    btc_markets: state => state.btc_markets,
    eth_markets: state => state.eth_markets,
    left_markets: state=> state.left_markets

}



export const mutations = {

    [types.GET_MARKETS] (state, {markets}) {
        state.btc_markets = markets.btc;
        state.eth_markets = markets.eth;
    },
    [types.GET_LEFTMARKETS] (state, {markets}) {
        state.left_markets = markets;

    }
}

export const actions = {
    getMarkets ({ commit, dispatch }, payload) {
        commit(types.GET_MARKETS, payload)
    },
    getLeftMarkets ({ commit, dispatch }, payload) {
        commit(types.GET_LEFTMARKETS, payload)
    }
}