import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'

export const state = {
    markets: null
}

export const getters = {
    markets: state => state.markets,
}

export const mutations = {
    [types.FETCH_MARKETS] (state, {markets}) {
        state.markets = markets;
    },

    [types.GET_MARKETS] (state, {markets}) {
        state.markets = markets;
    }
}

export const actions = {
    getMarkets ({ commit }, payload) {
        commit(types.GET_MARKETS, payload)
    }
}