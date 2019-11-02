function check_format(data, type) {
    switch (type) {
        case 'word':
            for (var i = 0; i < str.length; i++) {
                if (str[i] >= '0' && str[i] <= '9') return true;
            }
            return false;
    }
    return false;
}
