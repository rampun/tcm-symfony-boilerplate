import { gql } from 'graphql-request'
import { CommentFragment } from '@/graphql/auth/comment.fragment'

export const CommentsQuery = gql`
  query comments($search: String, $limit: Int!, $offset: Int!) {
    comments(search: $search) {
      items(limit: $limit, offset: $offset) {
        ...CommentFragment
      }
    }
  }
  ${CommentFragment}
`
