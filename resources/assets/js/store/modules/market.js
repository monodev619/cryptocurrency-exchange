import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'

export const state = {
    btc_markets: null,
    eth_markets: null,
    // markets: null,
}

export const getters = {
    btc_markets: state => state.btc_markets,
    eth_markets: state => state.eth_markets,
    getMarketId: (state) => (name) => {
        return state.btc_markets.find(market => market.name === name)
    }
}



export const mutations = {

    [types.GET_MARKETS] (state, {markets}) {
        state.btc_markets = markets.btc;
        state.eth_markets = markets.eth;
    }
}

export const actions = {
    getMarkets ({ commit, dispatch }, payload) {
        commit(types.GET_MARKETS, payload)
    }
}