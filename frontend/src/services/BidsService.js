import APIService from '@/services/APIService.js'

const backend_controller = '/bids/'
export default {
  bid (bid,idAuctionItem) {
    return APIService.apiCall().get(backend_controller+'bid/'+bid+'/'+idAuctionItem+'.json')
  },
  getItemHighestBid (idAuctionItem) {
    return APIService.apiCall().get(backend_controller+'get-item-highest-bid/'+idAuctionItem+'.json')
  },
}
