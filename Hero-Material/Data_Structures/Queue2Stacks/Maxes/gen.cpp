#include <bits/stdc++.h>
using namespace std;
typedef long long ll;

int main() {
  srand(time(NULL));
  int N, K, M;
  scanf("%d %d %d", &N, &K, &M);
  printf("%d %d %d %d\n", N, K, M, (N-K+1)/2);
  for(int i=1; i<=N; ++i) {
	printf("%lld\n", (ll)(rand())*(INT_MAX/20)+rand()-1);
  }
  printf("\n");
}
