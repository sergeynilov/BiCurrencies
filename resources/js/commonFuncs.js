import axios from 'axios'
import {usePage} from '@inertiajs/inertia-vue3';
import {settingsAwesomeFontLabels} from '@/app.settings'
import moment from 'moment-timezone'



export function showRTE(e) {
    // console.log('showRTE e::')
    // console.log(e)
    //
    // console.log('showRTE e.message::')
    // console.log(e.message)

    if ( !isEmpty(e) && !isEmpty( e.message)) {
        Toast.fire({
            icon: 'error',
            title: e.message
        })
    }

}

export function formattedLorem() {
    return '<p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.\n' +
        '</p>\n' +
        '<p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. <i>Excepteur sint  occaecat</i> cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.\n' +
        '</p>\n' +
        '<ul>\n' +
        '    <li>Lorem 1st point </li>\n' +
        '    <li>Lorem 2nd point </li>\n' +
        '    <li>Lorem 3rd point </li>\n' +
        '</ul>\n' +
        '<p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. <i>Excepteur sint  occaecat</i> cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.\n' +
        '</p>\n';
}


export function formatValue(value, rateDecimalNumbers) {
    let noLatestCurrencyHistoryLabel = 'Has no currency history yet'
    if (isEmpty( value ) ) return noLatestCurrencyHistoryLabel
    if ( typeof value === 'string' ) {
        value = parseFloat(value)
    }
    return value.toFixed(rateDecimalNumbers)
}


export function checkUrlPrefix(url) {
    if (!/^(f|ht)tps?:\/\//i.test(url)) {
        url = 'http://' + url
    }
    return url
}


export function dateIntoDbFormat(d) {
    // console.log('dateIntoDbFormat d::')
    // console.log(typeof d)
    // console.log(d)
    if (isEmpty(d))  {
        d = new Date()
    }
    let ret = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    return ret;
}
export function showFlashMessage() {
    let icon = 'success'

    let flash_message = usePage().props.value.jetstream.flash
    // console.log('showFlashMessage flash_message::')
    // console.log(flash_message)

    let flash_type = usePage().props.value.flash_type.message
    // console.log('showFlashMessage flash_type::')
    // console.log(flash_type)

    if ( !isEmpty(flash_message)  ) {
        // console.log('INSIDE flash_message::')
        // console.log(flash_message)
        // console.log(typeof flash_message)

        if (flash_type == 'warning') {
            icon = 'warning'
        }

        if (flash_type == 'error') {
            icon = 'error'
        }

        // console.log('icon::')
        // console.log(icon)
        // console.log('flash_message::')
        // console.log(flash_message)
        Toast.fire({
            icon: icon,
            title: flash_message
        })
    }
}

export function getErrorMessage(error) {
    console.log('getErrorMessage error::')
    console.log(typeof error)
    console.log(error)

    /*
                if (typeof error.response.status != 'undefined' && typeof error.response != 'undefined' && error.response.status === 400) {
                    if (typeof error.response.data.message != 'undefined') {
                        return "Validation error : " + error.response.data.message
                    }
                }
    */
    if (typeof error == 'object' /*&& typeof error != 'undefined' && error.response.status === 500*/) {
        let errorsList = Object.values(error)
        // console.log('errorsList::')
        // console.log(errorsList)
        /* getErrorMessage error::
appMixin.js?ec54:34 {0: 'message', 1: 'Currency # 36 not found 1 !' */
        if (typeof errorsList[0] != "undefined") {
            return "Runtime error : " + errorsList[0]
        }
    }
}

export function getFileSizeAsString(fileSize) {
    if (parseInt(fileSize) < 1024) {
        return fileSize + 'b'
    }
    if (parseInt(fileSize) < 1024 * 1024) {
        return Math.floor(fileSize / 1024) + 'kb'
    }
    return Math.floor(fileSize / (1024 * 1024)) + 'mb'
}

export function forumHasImage(forum) {
    if (typeof forum['filenameData'] === 'undefined') return false
    if (forum['filenameData'] === null) return false
    if (typeof forum['filenameData'].image_url === 'undefined') return false
    if (typeof forum['filenameData'].image_url === 'string') return true
    return true
}


export function moneyFormat(price) {
    if (typeof price === 'undefined' || typeof price === 'object') {
        price = 0
    }
    if (typeof price === 'string') {
        price = parseFloat(price)
    }
    return '$' + price.toFixed(2)
}

export function momentDatetime(datetime, datetimeFormat, defaultVal) {
    if (typeof datetime === 'undefined' || datetime === null) {
        if (typeof defaultVal !== 'undefined' && defaultVal !== null) {
            return defaultVal
        }
        return ''
    }
    if (typeof datetime === 'object') {
        return moment(datetime).format(datetimeFormat)
    }
    if (typeof datetime === 'string') {
        if (datetimeFormat === '') return ''
        let dt = moment(String(datetime))
        return dt.format(datetimeFormat)
    } // if (typeof datetime === "string") {
    return ''
} // momentDatetime(datetime, datetimeFormat, defaultVal) {

export function getDictionaryLabel(value, selectionsList, defaultValue) {
    if (typeof defaultValue === 'undefined') defaultValue = ''
    if (typeof selectionsList === 'undefined') return defaultValue
    var ret = defaultValue
    selectionsList.map((nextSelection/* , index */) => {
        if (nextSelection.code === value) {
            ret = nextSelection.label
        }
    })
    return ret
} // getDictionaryLabel( value, selectionsList, defaultValue ) {

export function upperCase(string) {
    if (typeof string !== 'string') return ''
    return string.toUpperCase()
}

export function lowerase(string) {
    if (typeof string !== 'string') return ''
    return string.toLowerCase(0)
}

export function concatStr(str, maxStrLengthInListing) {
    if (typeof str === 'undefined') str = ''
    if (str.length > maxStrLengthInListing) {
        return str.slice(0, maxStrLengthInListing) + '...'
    }
    return str
}

export function capitalize(string) {
    if (typeof string !== 'string') return ''
    return string.charAt(0).toUpperCase() + string.slice(1)
}

export function clearErrorMessage(s) {
    if (typeof s === 'undefined') return ''
    return capitalize(s.replace(/_/g, ' '))
}

export function timeInAgoFormat(value) {
    if (value === null || typeof value === 'undefined') return
    return capitalize(moment(value).fromNow())
}

//            {{ nextCategory.title }}<small> ( has {{ nextCategory.forums_count }} {{ pluralize3(nextCategory.forums_count, 'no forums',  'forum', 'forums') }} )</small>
// export function pluralize3(itemsLength, zeroLabel, singleLabel, pluralLabel) {
//   if (itemsLength <= 0) return zeroLabel
//   return itemsLength + ' ' + ( itemsLength > 1 ? pluralLabel : singleLabel )
// }

export function pluralize3(items_length, no_items_text, single_item_text, multi_items_text) {
    // console.log('pluralize3 items_length::')
    // console.log(items_length)
    // console.log(typeof items_length)
    if (typeof items_length !== 'number') return no_items_text // +" :12"
    if (items_length === 0) return no_items_text //  +" :13"
    if (items_length === 1) return single_item_text //  +" :14"
    if (items_length > 1) return multi_items_text //  +" :15"
}

export function pluralize(itemsLength, singleLabel, pluralLabel) {
    return itemsLength > 1 ? pluralLabel : singleLabel
}

export function clearTags(str) {
    if (typeof str !== 'string') return ''
    return str.replace(/<\/?[^>]+(>|$)/g, '')
}

export function getHeaderIcon(icon) {
    let retIcon = ''
    settingsAwesomeFontLabels.map((nextSettingsAwesomeFontLabel) => {
        if (nextSettingsAwesomeFontLabel.code === icon) {
            retIcon = nextSettingsAwesomeFontLabel.font
            return retIcon
        }
    })
    return retIcon
}

export function isEmpty(value) {
    if (typeof value === 'object') {
        if (value === null) return true
        if (value.length === 0) return true
    }
    if (value === undefined) return true
    if (value === null) return true
    if (value === '') return true
}

export function getSplitted(str, splitter, index) {
    if (typeof str === 'undefined') return ''
    var valuesArray = str.split(splitter)
    if (typeof valuesArray[index] !== 'undefined') {
        return valuesArray[index]
    }
    return ''
}


/*
export function getModalCalculatedWidth (deviceWidth) {
  if (deviceWidth <= 320) {
    // alert( -11 )
    return 300
  }
  if (deviceWidth > 320 && deviceWidth <= 480) {
    // alert( -22 )
    return 320
  }

  if (deviceWidth > 480 && deviceWidth <= 600) {
    // alert( -33 )
    return 310
  }

  if (deviceWidth > 600 && deviceWidth <= 768) {
    // alert( -44 )
    return 560
  }
  if (deviceWidth > 768 && deviceWidth <= 1024) {
    // alert( -55 )
    return 720
  }
  if (deviceWidth > 1024) {
    // alert( -66 )
    return 950
  }
}

export function getCalculatedWidth (deviceWidth) {
  if (deviceWidth <= 320) {
    // alert( -1 )
    return 300
  }
  if (deviceWidth > 320 && deviceWidth <= 480) {
    // alert( -2 )
    return 320
  }

  if (deviceWidth > 480 && deviceWidth <= 600) {
    // alert( -3 )
    return 310
  }

  if (deviceWidth > 600 && deviceWidth <= 768) {
    // alert( -4 )
    return 470
  }
  if (deviceWidth > 768 && deviceWidth <= 1024) {
    // alert( -5 )
    return 480
  }
  if (deviceWidth > 1024) {
    // alert( -6 )
    return 650
  }
}
*/

// function checkEmail (value) {
//   regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/
//   return regex.test(value)
// }
//
// function checkInteger (value) {
//   regex = /^[0-9]+$/
//   return regex.test(value)
// }
//
// function checkisNormalInteger (str, can_be_zero) {
//   var n = Math.floor(Number(str))
//   if (can_be_zero) {
//     return String(n) === str && n >= 0
//   } else {
//     return String(n) === str && n > 0
//   }
// }
//
// function var_dump (oElem, from_line, till_line) {
//   if (typeof oElem === 'undefined') return 'undefined'
//   var sStr = ''
//   if (typeof (oElem) === 'string' || typeof (oElem) === 'number') {
//     sStr = oElem
//   } else {
//     var sValue = ''
//     for (var oItem in oElem) {
//       sValue = oElem[oItem]
//       if (typeof (oElem) === 'innerHTML' || typeof (oElem) === 'outerHTML') {
//         sValue = sValue.replace(/</g, '&lt;').replace(/>/g, '&gt;')
//       }
//       sStr += 'obj.' + oItem + ' = ' + sValue + '\n'
//     }
//   }
//   //alert( "from_line::"+(typeof from_line) )
//   if (typeof from_line === 'number' && typeof till_line === 'number') {
//     return sStr.substr(from_line, till_line)
//   }
//   if (typeof from_line === 'number') {
//     return sStr.substr(from_line)
//   }
//   return sStr
// }
