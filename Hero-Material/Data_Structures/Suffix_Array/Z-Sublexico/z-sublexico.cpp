#include <cstdio>
#include <cstdlib>
#include <cmath>
#include <cstring>
#include <string>
#include <vector>
#include <deque>
#include <list>
#include <set>
#include <map>
#include <stack>
#include <queue>
#include <utility>
#include <algorithm>

#define MAXN 90005
#define MAXQ 505
#define INF 0x3f3f3f3f
#define X first
#define Y second
#define mp make_pair

using namespace std;

typedef long long llint;
typedef pair<int,int> pii;

int len, step, P[30][MAXN], Q, sorted[MAXN], dsub[MAXN], q[MAXQ];
pair< int, pii > temp[MAXN];
char str[MAXN];

int LCP ( int a, int b ) {
    int st, ans=0;

    for ( st=step-1; st>=0 && a<len && b<len; --st ) {
        if ( P[st][a] == P[st][b] ) {
            ans += ( 1<<st );
            a += ( 1<<st );
            b += ( 1<<st );
        }
    }

    return ans;
}

void Answer_Queries () {
    int i, lo, hi, mid, j, to;

    for ( i=1; i<=Q; ++i ) {
        lo = 0;
        hi = len-1;
        while ( lo < hi ) {
            mid = (lo+hi) / 2;
            if ( dsub[mid] < q[i] ) {
                lo = mid + 1;
            }
            else {
                hi = mid;
            }
        }
        
        if ( lo > 0 ) {
            q[i] -= dsub[lo-1];
            to = sorted[lo] + LCP (sorted[lo], sorted[lo-1]) + q[i] - 1;
        }
        else {
            to = sorted[lo] + q[i] - 1;
        }

        for ( j=sorted[lo] ; j<=to; ++j ) {
            putc (str[j], stdout);
        }
        putc ('\n', stdout);
    }
}

void Compute_Distinct_Substrings() {
    int i;

    dsub[0] = len-sorted[0];
    for ( i=1; i<len; ++i ) {
        dsub[i] = len-sorted[i]-LCP(sorted[i],sorted[i-1]);
        dsub[i] += dsub[i-1];
    }

}

void Make_Array () {
    int i, j, count;

    for ( i=0; i<len; ++i ) {
        P[0][i] = str[i];
    }

    for ( step=1, j=1; j<len; j<<=1, ++step ) {
        for ( i=0; i<len; ++i ) {
            temp[i] = mp ( P[step-1][i], mp ( i+j < len ? P[step-1][i+j] : -1, i) );
        }
        sort ( temp, temp+len );
        count = 0;
        P[step][ temp[0].Y.Y ] = 0;
        for ( i=1; i<len; ++i ) {
            if ( temp[i].X != temp[i-1].X || temp[i].Y.X != temp[i-1].Y.X ) {
                ++count;
            }
            P[step][ temp[i].Y.Y ] = count;
        }
    }
    
    --step;
    for ( i=0; i<len; ++i ) {
        sorted[i] = temp[i].Y.Y;
    }
}

void Read () {
    int i;

    scanf ("%s %d", str, &Q);
    len = strlen(str);
    for ( i=1; i<=Q; ++i ) {
        scanf ("%d", &q[i]);
    }
}

int main ( void ) {
#ifdef DEBUG
    freopen ("input","r",stdin);
#endif

    Read();
    Make_Array();
    Compute_Distinct_Substrings();
    Answer_Queries();

    return 0;
}
