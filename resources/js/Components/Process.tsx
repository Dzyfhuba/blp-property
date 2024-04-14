import PairwiseComparisonImage from '@/Images/pairwise-comparison.png'
import PriorityImage from '@/Images/priority.png'
import LineQualityImage from '@/Images/line-quality.png'
import Zoom from 'react-medium-image-zoom'
import 'react-medium-image-zoom/dist/styles.css'
import { columns } from '@/Variables/criterion'
import type { SmarterResponse } from '@/types/smarter-response'
import Image from './Image'
import { useState } from 'react'

type Props = {
    data: SmarterResponse
    productId?: number
}

const Process = (props: Props) => {
  const [productId, setProductId] = useState(props.productId)
  const selectedModel = props.data.models.filter(value => value.product_id === productId)[0]

  const distanceWithSearch = (a:number) => Math.abs(a - props.data.search.total)

  if (!props.data.models) {
    return (
      <>model fail</>
    )
  }

  return (
    <div
      className='flex flex-col gap-3'
    >
      <a href='/paper'
        className='btn btn-link hover:no-underline btn-sm'
        target='_blank'
      >Show Paper</a>
      {/* Pairwise Comparison */}
      <article id="pairwise-comparison">
        <h1 className='text-2xl font-bold'>Pairwise Comparison</h1>
        <Zoom>
          <img src={PairwiseComparisonImage}
            alt='pairwise comparison'
            className='max-h-11 mx-auto'
          />
        </Zoom>
        <div className='overflow-x-auto'>
          <table className='table table-pin-cols'>
            <thead>
              <tr>
                <th></th>
                {Object.keys(props.data.pairwise_comparison).map((key, idx) => (
                  <td key={idx}
                  >
                    {key}
                  </td>
                ))}
              </tr>
            </thead>
            <tbody>
              {columns.map((column1, idx) => (
                <tr key={idx}>
                  <th className='whitespace-nowrap'>{column1}</th>
                  {columns.map((column2, idx) => (
                    <td key={idx}
                      className='whitespace-nowrap'
                    >{props.data.pairwise_comparison[column1][column2]}</td>
                  ))}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </article>

      <select
        className='select'
        onChange={(e) => setProductId(parseInt(e.target.value))}
        defaultValue={productId}
      >
        <option value=""
          hidden
        >Pilih Rumah</option>
        {props.data.models.sort((a,b) => distanceWithSearch(a.total || 0) - distanceWithSearch(b.total || 0)).map(model => (
          <option key={model.id}
            value={model.product_id}
          >{model.product.category?.name}: {model.product.name} {distanceWithSearch(model.total || 0).toFixed(3)}</option>
        ))}
      </select>

      {selectedModel ? (
        //   priority, line quality and total
        <article id="model">
          <h1 className='text-2xl font-bold'>Priority</h1>
          <div className='flex flex-col gap-3 sm:flex-row justify-center'>
            <Zoom>
              <img src={PriorityImage}
                alt='model'
                className='max-h-11 mx-auto'
              />
            </Zoom>
            <Zoom>
              <img src={LineQualityImage}
                alt='line quality'
                className='max-h-11 mx-auto'
              />
            </Zoom>
          </div>
          <div className='w-max grid grid-cols-2 mx-auto gap-3 text-start'>
            <span>Consistency Ratio</span><span>{selectedModel.pairwise_comparison_consistency_ratio || 0}</span>
            <span>Total</span><span>{selectedModel.total}</span>
            <span>Distance <span className='text-xs'>ABS({selectedModel.total} - {props.data.search.total})</span></span><span className='font-black'>{distanceWithSearch(selectedModel.total || 0)}</span>
          </div>
          <div className='overflow-x-auto'>
            <table className='table table-pin-cols'>
              <thead>
                <tr>
                  <th></th>
                  {columns.map((key, idx) => (
                    <td key={idx}
                    >
                      {key}
                    </td>
                  ))}
                  <td>priority</td>
                  <td>line quality</td>
                </tr>
              </thead>
              <tbody>
                {columns.map((column1, idx) => (
                  <tr key={idx}>
                    <th className='whitespace-nowrap'>{column1}</th>
                    {columns.map((column2, idx) => (
                      <td key={idx}
                        className='whitespace-nowrap'
                      >{selectedModel.pairwise_comparison_normalized![column1][column2]}</td>
                    ))}
                    <td className='whitespace-nowrap'>{selectedModel.pairwise_comparison_priority![column1]}</td>
                    <td className='whitespace-nowrap'>{selectedModel.pairwise_comparison_line_quality![column1]}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </article>
      ) : <></>}

      {/* search */}
      <article id="search">
        <h1 className='text-2xl font-bold'>Search</h1>

      </article>
    </div>
  )
}

export default Process
